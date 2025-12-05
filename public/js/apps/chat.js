/**
 * 
 * Chat
 * Integrated with Laravel Reverb/Echo for real-time functionality.
 * 
 */

class Chat {
    get options() {
        return {};
    }

    constructor(options = {}) {
        this.settings = Object.assign(this.options, options);
        this.messagesListContainer = document.getElementById('messagesListContainer');
        this.contactsListContainer = document.getElementById('contactsListContainer');
        this.userProfileTabs = document.getElementById('userProfileTabs');
        this.chatContentContainer = document.getElementById('chatContentContainer');
        this.listItemTemplate = document.getElementById('listItemTemplate');
        this.chatContentScroll = null;
        this.mobileBreakpoint = Globals.md.replace('px', '');
        this.respondContainerTemplate = document.getElementById('respondContainerTemplate');
        this.respondAttachmentContentTemplate = document.getElementById('respondAttachmentContentTemplate');
        this.respondTextContentTemplate = document.getElementById('respondTextContentTemplate');
        this.messageContainerTemplate = document.getElementById('messageContainerTemplate');
        this.messageAttachmentContentTemplate = document.getElementById('messageAttachmentContentTemplate');
        this.messageTextContentTemplate = document.getElementById('messageTextContentTemplate');
        this.currentMode = 'chat'; //chat - call
        this.currentView = null; //mobile - desktop
        this.chatView = document.getElementById('chatView');
        this.listView = document.getElementById('listView');

        this.chatInput = document.querySelector('#chatInput');
        this.currentChatData = null;
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        this._loadData();
    }

    _loadData() {
        fetch(chatContactsUrl)
            .then(response => response.json())
            .then(data => {
                this.chatData = data.map((d) => {
                    // Ensure correct URL formatting if needed
                    return {...d };
                });

                // Handle Start Chat Trigger
                if (typeof targetUser !== 'undefined' && targetUser) {
                    const exists = this.chatData.find(u => u.id === targetUser.id);
                    if (!exists) {
                        this.chatData.unshift(targetUser);
                    }
                }

                this._init();
            })
            .catch(error => console.error('Error loading contacts:', error));
    }

    _init() {
        this._initView();
        this._initMode();
        this._initScrollbars();
        this._renderContacts();
        this._initTextArea();
        this._addListeners();
        this._initEcho();

        // Select target user if triggered
        if (typeof targetUser !== 'undefined' && targetUser) {
            this._renderChatMessagesById(targetUser.id);
            // If mobile, show chat view
            if (this.currentView === 'mobile') {
                this._updateView();
            }
        } else if (this.currentView === 'desktop' && this.chatData.length > 0) {
            this._renderChatMessagesById(this.chatData[0].id);
        }
        
        this._updateChatScrollDelayed();
    }

    _initEcho() {
        if (typeof Echo !== 'undefined') {
            Echo.private('chat.' + currentUserId)
                .listen('MessageSent', (e) => {
                    console.log('Message received:', e);
                    this._handleIncomingMessage(e.message, e.user);
                });
        } else {
            console.warn('Laravel Echo not defined.');
        }
    }

    _handleIncomingMessage(message, sender) {
        // Find if contact exists
        let contact = this.chatData.find(u => u.id === sender.id);
        
        // If contact doesn't exist (new conversation), add them
        if (!contact) {
            // If I am the sender (from another tab), I need to find the receiver, not sender.
            // But wait, if I sent it to User B, the 'sender' in the event is Me.
            // The 'message' object has 'receiver_id'.
            // So if sender.id === currentUserId, the contact is message.receiver_id.
            
            let contactId = sender.id;
            if (sender.id === currentUserId) {
                 contactId = message.receiver_id;
                 // We need to fetch this user's info if not in list?
                 // For now, let's assume we only add if we receive FROM someone else.
                 // If we are sending to a new user from Tab 1, Tab 2 might not have that user in list.
                 // We might need to fetch user info.
                 // But for simplicity, let's fallback to a placeholder or ignore if complex.
                 
                 // Actually, if I am sending to B, and B is not in Tab 2's list.
                 // Tab 2 receives event. contactId is B.
                 // contact is undefined.
                 // We create a placeholder for B.
            }

            contact = {
                id: contactId,
                name: sender.id === currentUserId ? 'Unknown' : sender.name, // We might not have receiver name if we are sender
                thumb: 'img/profile/profile-1.webp', 
                last: 'Just now',
                status: 'Online',
                unread: 0,
                messages: []
            };
            // Ideally we fetch the user info here if missing.
            this.chatData.unshift(contact);
            this._renderContacts();
        }

        // Format message
        const formattedMsg = {
            type: sender.id === currentUserId ? 'message' : 'response',
            text: message.message,
            time: moment(message.created_at).format('HH:mm'),
            attachments: []
        };

        contact.messages.push(formattedMsg);
        
        // If this is the active chat, render it
        if (this.currentChatData && this.currentChatData.id === contact.id) {
             this._renderChatMessage(formattedMsg, this.chatContentContainer.querySelector('.os-content'));
             this._updateChatScroll();
        } else {
            if (sender.id !== currentUserId) {
                contact.unread++;
            }
            this._renderContacts(); 
        }
        
        // Update last message time
        contact.last = 'Just now';
    }

    // Initializing view and updating view variable
    _initView() {
        const windowWidth = window.innerWidth;
        let newView = null;
        if (this.mobileBreakpoint > windowWidth) {
            newView = 'mobile';
        } else {
            newView = 'desktop';
        }
        if (newView !== this.currentView) {
            if (this.currentView === 'mobile' && this.currentChatData === null && this.chatData.length > 0) {
                this._renderChatMessagesById(this.chatData[0].id);
            }
            this.currentView = newView;
            this._updateView();
        }
    }

    // Switching between views for mobile and desktop. Showing only chat or only user list at a time for mobile and showing both for desktop
    _updateView() {
        if (this.currentView === 'mobile') {
            // Init mobile view
            if (this.currentChatData) {
                // Show chat view
                this._showChatView();
                this._enableBackButton();
            } else {
                // Show list view
                this._showListView();
                this._disableBackButton();
            }
            this._showChatBackButton();
        } else {
            // Init desktop view
            this._showBothViews();
            this._hideChatBackButton();
        }
    }

    // Showing chat view
    _showChatView() {
        this.chatView.classList.remove('d-none');
        this.chatView.classList.add('d-flex');
        this.listView.classList.remove('d-flex');
        this.listView.classList.add('d-none');
    }

    // Showing contact list view
    _showListView() {
        this.chatView.classList.add('d-none');
        this.chatView.classList.remove('d-flex');
        this.listView.classList.add('d-flex');
        this.listView.classList.remove('d-none');
    }

    // Showing both list view and chat view
    _showBothViews() {
        this.chatView.classList.remove('d-none');
        this.chatView.classList.add('d-flex');
        this.listView.classList.add('d-flex');
        this.listView.classList.remove('d-none');
    }

    _enableBackButton() {
        document.getElementById('backButton').classList.remove('disabled');
    }

    _disableBackButton() {
        document.getElementById('backButton').classList.add('disabled');
    }

    // Switching 'mode' between chat and call
    _initMode() {
        if (this.currentMode === 'chat') {
            document.getElementById('chatMode').classList.remove('d-none');
            document.getElementById('chatMode').classList.add('d-flex');
            document.getElementById('callMode').classList.remove('d-flex');
            document.getElementById('callMode').classList.add('d-none');
            this._endTimer();
        } else {
            document.getElementById('callMode').classList.remove('d-none');
            document.getElementById('callMode').classList.add('d-flex');
            document.getElementById('chatMode').classList.remove('d-flex');
            document.getElementById('chatMode').classList.add('d-none');
            this._renderCall();
        }
    }

    // Adding listeners for buttons, resize and keyboard
    _addListeners() {
        this.chatInput.addEventListener('keydown', this._onChatInputKeyDown.bind(this));
        document.getElementById('chatSendButton') && document.getElementById('chatSendButton').addEventListener('click', this._inputSend.bind(this));
        document.getElementById('chatAttachButton') && document.getElementById('chatAttachButton').addEventListener('click', this._attachmentSend.bind(this));
        document.getElementById('chatAttachmentInput') &&
            document.getElementById('chatAttachmentInput').addEventListener('change', this._onAttachmentChange.bind(this));
        document.getElementById('backButton') && document.getElementById('backButton').addEventListener('click', this._onBackClick.bind(this));
        document.getElementById('endCallButton') && document.getElementById('endCallButton').addEventListener('click', this._onEndCallClick.bind(this));
        document.getElementById('callButton') && document.getElementById('callButton').addEventListener('click', this._onCallClick.bind(this));
        document.getElementById('videoCallButton') && document.getElementById('videoCallButton').addEventListener('click', this._onCallClick.bind(this));

        this.userProfileTabs && this.userProfileTabs.addEventListener('click', this._onContactListClick.bind(this));
        window.addEventListener('resize', Helpers.Debounce(this._onResizeDebounced.bind(this), 200).bind(this));
        window.addEventListener('resize', this._onResize.bind(this));
    }

    // Showing back button for chat screens
    _showChatBackButton() {
        document.getElementById('backButton').classList.remove('d-none');
    }

    // Hiding back button for call screens
    _hideChatBackButton() {
        document.getElementById('backButton').classList.add('d-none');
    }

    // Resize with a debounce
    _onResizeDebounced(event) {
        this._updateChatScroll();
    }

    // Resize handler
    _onResize(event) {
        this._initView();
    }

    // End click listener
    _onEndCallClick(event) {
        this.currentMode = 'chat';
        this._initMode();
    }

    // Call click listener
    _onCallClick(event) {
        this.currentMode = 'call';
        this._initMode();
    }

    // Call screen
    _renderCall() {
        const callMode = document.getElementById('callMode');
        callMode.querySelector('.name').innerHTML = this.currentChatData.name;
        callMode.querySelector('.profile').setAttribute('src', this.currentChatData.thumb);
        this._startTimer(callMode.querySelector('.time'));
    }

    // Call screen timer starter
    _startTimer(timer) {
        timer.innerHTML = '00:00:00';
        var startTimestamp = moment().startOf('day');
        this.timerInterval = setInterval(function() {
            startTimestamp.add(1, 'second');
            timer.innerHTML = startTimestamp.format('HH:mm:ss');
        }, 1000);
    }

    // Call screen timer clear
    _endTimer() {
        if (this.timerInterval) {
            clearInterval(this.timerInterval);
        }
    }

    // Back button listener for mobile
    _onBackClick(event) {
        this.currentChatData = null;
        this._renderContacts();
        this._showListView();
        this._disableBackButton();
        if (this.currentMode !== 'chat') {
            this.currentMode = 'chat';
            this._initMode();
        }
    }

    // Renders all the users both from messages and contacts
    _renderContacts() {
        this.messagesListContainer.querySelector('.os-content').innerHTML = '';
        this.contactsListContainer.querySelector('.os-content').innerHTML = '';
        this.chatData.map((contact) => {
            contact.messages && contact.messages.length > 0 && this._renderContact(contact, this.messagesListContainer.querySelector('.os-content'));
            this._renderContact(contact, this.contactsListContainer.querySelector('.os-content'));
        });
    }

    // Renders a single user
    _renderContact(contact, container) {
        var itemClone = this.listItemTemplate.content.cloneNode(true).querySelector('a');
        itemClone.setAttribute('data-id', contact.id);
        itemClone.querySelector('#contactName').innerHTML = contact.name;
        itemClone.querySelector('#contactLastSeen').innerHTML = contact.last;
        itemClone.querySelector('#contactImage').setAttribute('src', contact.thumb);
        if (contact.status !== 'Online') {
            itemClone.querySelector('#contactStatus').classList.add('d-none');
        }
        if (contact.unread > 0) {
            itemClone.querySelector('#contactUnread').innerHTML = contact.unread;
            itemClone.querySelector('#contactUnread').classList.remove('d-none');
        }
        container.append(itemClone);
    }

    // Sets name and image of the title in the chat container
    _renderContactTitle() {
        const contactTitle = document.getElementById('contactTitle');
        contactTitle.querySelector('.name').innerHTML = this.currentChatData.name;
        // contactTitle.querySelector('.last').innerHTML = this.currentChatData.last; // Can be dynamic
        contactTitle.querySelector('.profile').setAttribute('src', this.currentChatData.thumb);
        if (this.currentChatData.status !== 'Online') {
            contactTitle.querySelector('.status').classList.add('d-none');
        }
    }

    // Sets selected contact
    _setActiveContact() {
        this.userProfileTabs.querySelectorAll('.contact-list-item').forEach((element) => {
            element.classList.remove('active');
            if (parseInt(element.getAttribute('data-id')) === parseInt(this.currentChatData.id)) {
                element.classList.add('active');
            }
        });
    }

    // Makes unread message zero
    _setAsRead() {
        if (this.currentChatData.unread > 0) {
            this.currentChatData.unread = 0;
            this._renderContacts();
            this._setActiveContact();
        }
    }

    // Renders all the messages and responses from a clicked person
    _renderChatMessagesById(id) {
        this.currentChatData = this._getDataById(id);
        this.chatContentContainer.querySelector('.os-content').innerHTML = '<div class="text-center p-2">Loading...</div>';
        
        const url = chatMessagesUrl.replace(':id', id);
        fetch(url)
            .then(res => res.json())
            .then(messages => {
                 this.currentChatData.messages = messages;
                 this.chatContentContainer.querySelector('.os-content').innerHTML = '';
                 messages.map((chat) => {
                    this._renderChatMessage(chat, this.chatContentContainer.querySelector('.os-content'));
                });
                this._renderContactTitle();
                baguetteBox.run('.lightbox');
                this._updateChatScroll();
                this._setActiveContact();
                this._setAsRead();
            })
            .catch(err => {
                console.error("Error fetching messages", err);
                this.chatContentContainer.querySelector('.os-content').innerHTML = '<div class="text-center p-2 text-danger">Error loading messages.</div>';
            });
    }

    // Renders a single chat message or response
    _renderChatMessage(chat, container) {
        var itemClone = null;
        var containerClone = null;
        if (chat.type === 'response') {
            // Adding content from the contact
            containerClone = this.respondContainerTemplate.content.cloneNode(true).querySelector('div');
            containerClone.querySelector('.chat-profile').setAttribute('src', this.currentChatData.thumb);
            if (chat.text !== '') {
                itemClone = this.respondTextContentTemplate.content.cloneNode(true).querySelector('div');
                itemClone.querySelector('.text').innerHTML = chat.text;
                itemClone.querySelector('.time').innerHTML = chat.time;
                containerClone.querySelector('.content-container').append(itemClone);
                container.append(containerClone);
            } else {
                chat.attachments.map((attachment) => {
                    itemClone = this.respondAttachmentContentTemplate.content.cloneNode(true).querySelector('div');
                    itemClone.querySelector('.attachment img').setAttribute('src', attachment);
                    itemClone.querySelector('.attachment').setAttribute('href', attachment);
                    containerClone.querySelector('.content-container').append(itemClone);
                    container.append(containerClone);
                });
            }
        } else {
            // Adding content from the user
            containerClone = this.messageContainerTemplate.content.cloneNode(true).querySelector('div');
            if (chat.text !== '') {
                itemClone = this.messageTextContentTemplate.content.cloneNode(true).querySelector('div');
                itemClone.querySelector('.text').innerHTML = chat.text;
                itemClone.querySelector('.time').innerHTML = chat.time;
                containerClone.querySelector('.content-container').append(itemClone);
                container.append(containerClone);
            } else {
                chat.attachments.map((attachment) => {
                    itemClone = this.messageAttachmentContentTemplate.content.cloneNode(true).querySelector('div');
                    itemClone.querySelector('.attachment img').setAttribute('src', attachment);
                    itemClone.querySelector('.attachment').setAttribute('href', attachment);
                    containerClone.querySelector('.content-container').append(itemClone);
                    container.append(containerClone);
                });
            }
        }
    }

    // Returns chat data from the array by id
    _getDataById(id) {
        return this.chatData.find((data) => {
            if (data.id === id) {
                return data;
            }
        });
    }

    // Implementing the autosize plugin to make text area expand
    _initTextArea() {
        autosize(this.chatInput);
        this.chatInput.addEventListener('autosize:resized', this._chatInputResize.bind(this));
    }

    _chatInputResize() {
        this._updateChatScroll();
    }

    // Click listener for input send button, also called via enter key press.
    _inputSend(event) {
        const text = this.chatInput.value;
        if (!text.trim()) return;

        const message = {
            type: 'message',
            text: text,
            time: moment().format('HH:mm'),
            attachments: [],
        };

        this.chatInput.value = '';
        this.chatInput.focus();
        
        // Optimistic update
        this._renderChatMessage(message, this.chatContentContainer.querySelector('.os-content'));
        this._updateChatScroll();
        this._updateChatData(message);

        // Send to API
        fetch(chatSendUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': this.csrfToken
            },
            body: JSON.stringify({
                receiver_id: this.currentChatData.id,
                message: text
            })
        }).then(res => res.json())
          .then(data => { 
              console.log('Message sent', data);
          })
          .catch(err => console.error('Error sending message', err));
    }

    // Updates and changes message from tha data.
    _updateChatData(message) {
        // const messageCount = this.currentChatData.messages.length;
        this.currentChatData.messages.push(message);
        // Move contact to top of list
        const index = this.chatData.indexOf(this.currentChatData);
        if (index > -1) {
            this.chatData.splice(index, 1);
            this.chatData.unshift(this.currentChatData);
        }
        this._renderContacts();
        this._setActiveContact();
    }

    // Attach button click listener, triggers a click on the hidden file input.
    _attachmentSend(event) {
        document.getElementById('chatAttachmentInput').dispatchEvent(new MouseEvent('click'));
    }

    // Attachment input change listener
    _onAttachmentChange(event) {
        const input = document.getElementById('chatAttachmentInput');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = (onLoadEvent) => {
                const attachment = {
                    type: 'message',
                    text: '',
                    time: moment().format('HH:mm'),
                    attachments: [onLoadEvent.target.result + '#.webp'], 
                };
                this._renderChatMessage(attachment, this.chatContentContainer.querySelector('.os-content'));
                baguetteBox.destroy();
                baguetteBox.run('.lightbox');
                this._updateChatScroll();
                this._updateChatData(attachment);
                
                // Note: Attachment uploading logic to backend is not implemented in this snippet.
                // You would need a FormData upload endpoint.
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Keydown listener for the main chat input to determine enter vs shift+enter.
    _onChatInputKeyDown(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            if (event.shiftKey) {
                var currentValue = this.chatInput.value;
                currentValue += '\n';
                this.chatInput.value = currentValue;
                autosize.update(this.chatInput);
                this._updateChatScroll();
            } else {
                this._inputSend();
            }
        }
    }

    // Click listener for contact list items.
    _onContactListClick(event) {
        if (this.currentMode !== 'chat') {
            return;
        }
        const contactElement = event.target.closest('.contact-list-item');
        if (contactElement) {
            const contactId = contactElement.getAttribute('data-id');
            // Check if we need to load
            this.currentChatData = this._getDataById(parseInt(contactId));
            this._updateView();
            this._renderChatMessagesById(parseInt(contactId));
        }
    }

    // Initializing contact list and chat scrollbars and keeping a reference for chat scroll.
    _initScrollbars() {
        if (typeof OverlayScrollbars !== 'undefined') {
            OverlayScrollbars(this.messagesListContainer, { scrollbars: { autoHide: 'leave', autoHideDelay: 600 }, overflowBehavior: { x: 'hidden', y: 'scroll' } });
            OverlayScrollbars(this.contactsListContainer, { scrollbars: { autoHide: 'leave', autoHideDelay: 600 }, overflowBehavior: { x: 'hidden', y: 'scroll' } });
            this.chatContentScroll = OverlayScrollbars(this.chatContentContainer, {
                scrollbars: { autoHide: 'leave', autoHideDelay: 600 },
                overflowBehavior: { x: 'hidden', y: 'scroll' },
            });
        }
    }

    // Updating the chat scrollbar to make it scroll to the bottom.
    _updateChatScroll() {
        if (this.chatContentScroll) {
             this.chatContentScroll.scroll({ el: this.chatContentContainer.querySelector('.card-content:last-of-type'), scroll: { x: 'never' }, block: 'end' }, 0);
        }
    }

    // A delayed version of chat scroll update since it does not work when used without delay on the initial call.
    _updateChatScrollDelayed() {
        setTimeout(() => {
            this._updateChatScroll();
            this.chatContentContainer.classList.remove('opacity-0');
        }, 100);
    }
}
