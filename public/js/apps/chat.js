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
        this.currentMode = 'chat';
        this.currentView = null;
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

                    return {...d };
                });


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


        if (typeof targetUser !== 'undefined' && targetUser) {
            this._renderChatMessagesById(targetUser.id);

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

        const targetContactId = sender.id === currentUserId ? message.receiver_id : sender.id;


        let contact = this.chatData.find(u => u.id === targetContactId);


        if (!contact) {
            contact = {
                id: targetContactId,
                name: sender.id === currentUserId ? 'Unknown' : sender.name,
                thumb: 'img/profile/profile-1.webp',
                last: 'Just now',
                status: 'Online',
                unread: 0,
                messages: []
            };

            this.chatData.unshift(contact);
            this._renderContacts();
        }


        if (sender.id === currentUserId) {
            const lastMessages = contact.messages.slice(-5);
            const isDuplicate = lastMessages.some(m => m.text === message.message && m.type === 'message');
            if (isDuplicate) {
                return;
            }
        }


        const formattedMsg = {
            type: sender.id === currentUserId ? 'message' : 'response',
            text: message.message,
            time: moment(message.created_at).format('HH:mm'),
            attachments: []
        };

        contact.messages.push(formattedMsg);


        if (this.currentChatData && this.currentChatData.id === contact.id) {
            this._renderChatMessage(formattedMsg, this.chatContentContainer.querySelector('.os-content'));
            this._updateChatScroll();
        } else {
            if (sender.id !== currentUserId) {
                contact.unread++;
            }
            this._renderContacts();
        }


        contact.last = 'Just now';
    }


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


    _updateView() {
        if (this.currentView === 'mobile') {

            if (this.currentChatData) {

                this._showChatView();
                this._enableBackButton();
            } else {

                this._showListView();
                this._disableBackButton();
            }
            this._showChatBackButton();
        } else {

            this._showBothViews();
            this._hideChatBackButton();
        }
    }


    _showChatView() {
        this.chatView.classList.remove('d-none');
        this.chatView.classList.add('d-flex');
        this.listView.classList.remove('d-flex');
        this.listView.classList.add('d-none');
    }


    _showListView() {
        this.chatView.classList.add('d-none');
        this.chatView.classList.remove('d-flex');
        this.listView.classList.add('d-flex');
        this.listView.classList.remove('d-none');
    }


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


    _showChatBackButton() {
        document.getElementById('backButton').classList.remove('d-none');
    }


    _hideChatBackButton() {
        document.getElementById('backButton').classList.add('d-none');
    }


    _onResizeDebounced(event) {
        this._updateChatScroll();
    }


    _onResize(event) {
        this._initView();
    }


    _onEndCallClick(event) {
        this.currentMode = 'chat';
        this._initMode();
    }


    _onCallClick(event) {
        this.currentMode = 'call';
        this._initMode();
    }


    _renderCall() {
        const callMode = document.getElementById('callMode');
        callMode.querySelector('.name').innerHTML = this.currentChatData.name;
        callMode.querySelector('.profile').setAttribute('src', this.currentChatData.thumb);
        this._startTimer(callMode.querySelector('.time'));
    }


    _startTimer(timer) {
        timer.innerHTML = '00:00:00';
        var startTimestamp = moment().startOf('day');
        this.timerInterval = setInterval(function() {
            startTimestamp.add(1, 'second');
            timer.innerHTML = startTimestamp.format('HH:mm:ss');
        }, 1000);
    }


    _endTimer() {
        if (this.timerInterval) {
            clearInterval(this.timerInterval);
        }
    }


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


    _renderContacts() {
        this.messagesListContainer.querySelector('.os-content').innerHTML = '';
        this.contactsListContainer.querySelector('.os-content').innerHTML = '';
        this.chatData.map((contact) => {
            contact.messages && contact.messages.length > 0 && this._renderContact(contact, this.messagesListContainer.querySelector('.os-content'));
            this._renderContact(contact, this.contactsListContainer.querySelector('.os-content'));
        });
    }


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


    _renderContactTitle() {
        const contactTitle = document.getElementById('contactTitle');
        contactTitle.querySelector('.name').innerHTML = this.currentChatData.name;

        contactTitle.querySelector('.profile').setAttribute('src', this.currentChatData.thumb);
        if (this.currentChatData.status !== 'Online') {
            contactTitle.querySelector('.status').classList.add('d-none');
        }
    }


    _setActiveContact() {
        this.userProfileTabs.querySelectorAll('.contact-list-item').forEach((element) => {
            element.classList.remove('active');
            if (parseInt(element.getAttribute('data-id')) === parseInt(this.currentChatData.id)) {
                element.classList.add('active');
            }
        });
    }


    _setAsRead() {
        if (this.currentChatData.unread > 0) {
            this.currentChatData.unread = 0;
            this._renderContacts();
            this._setActiveContact();
        }
    }


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


    _renderChatMessage(chat, container) {
        var itemClone = null;
        var containerClone = null;
        if (chat.type === 'response') {

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


    _getDataById(id) {
        return this.chatData.find((data) => {
            if (data.id === id) {
                return data;
            }
        });
    }


    _initTextArea() {
        autosize(this.chatInput);
        this.chatInput.addEventListener('autosize:resized', this._chatInputResize.bind(this));
    }

    _chatInputResize() {
        this._updateChatScroll();
    }


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


        this._renderChatMessage(message, this.chatContentContainer.querySelector('.os-content'));
        this._updateChatScroll();
        this._updateChatData(message);


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


    _updateChatData(message) {

        this.currentChatData.messages.push(message);

        const index = this.chatData.indexOf(this.currentChatData);
        if (index > -1) {
            this.chatData.splice(index, 1);
            this.chatData.unshift(this.currentChatData);
        }
        this._renderContacts();
        this._setActiveContact();
    }


    _attachmentSend(event) {
        document.getElementById('chatAttachmentInput').dispatchEvent(new MouseEvent('click'));
    }


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



            };
            reader.readAsDataURL(input.files[0]);
        }
    }


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


    _onContactListClick(event) {
        if (this.currentMode !== 'chat') {
            return;
        }
        const contactElement = event.target.closest('.contact-list-item');
        if (contactElement) {
            const contactId = contactElement.getAttribute('data-id');

            this.currentChatData = this._getDataById(parseInt(contactId));
            this._updateView();
            this._renderChatMessagesById(parseInt(contactId));
        }
    }


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


    _updateChatScroll() {
        if (this.chatContentScroll) {
            this.chatContentScroll.scroll({ el: this.chatContentContainer.querySelector('.card-content:last-of-type'), scroll: { x: 'never' }, block: 'end' }, 0);
        }
    }


    _updateChatScrollDelayed() {
        setTimeout(() => {
            this._updateChatScroll();
            this.chatContentContainer.classList.remove('opacity-0');
        }, 100);
    }
}