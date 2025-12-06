@extends('dashboard.layouts.app')

@section('content')
<main>
    <div class="container d-flex flex-column">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <div class="col-auto mb-2 mb-md-0">
                    <div class="sw-md-30 sw-lg-40 w-100">
                        <h3 class="mb-0 pb-0 display-4" id="title">Pesan Anda</h3>
                    </div>
                </div>
                <div class="col-12 col-md d-flex align-items-start justify-content-md-end">
                    <button type="button" class="btn btn-icon btn-icon-only btn-outline-primary ms-1 d-none" id="backButton">
                        <i data-acorn-icon="arrow-left"></i>
                    </button>
                    <!-- <button type="button" class="btn btn-outline-primary btn-icon btn-icon-start ms-1 w-100 w-md-auto" disabled>
                  <i data-acorn-icon="plus"></i>
                  <span>Pesan Baru</span>
                </button> -->
                </div>
            </div>
        </div>
        <!-- Title and Top Buttons End -->

        <div class="row d-flex flex-grow-1 overflow-hidden pb-2 h-100">
            <!-- Contact and Message List Start -->
            <div class="col-auto w-100 w-md-auto h-100 d-none" id="listView">
                <div class="sw-md-30 sw-lg-40 w-100 d-flex flex-column h-100">
                    <div class="card h-100">
                        <div class="card-header border-0 pb-0">
                            <ul class="nav nav-tabs nav-tabs-line card-header-tabs" role="tablist">
                                <li class="nav-item w-50 text-center" role="presentation">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#messages" role="tab" aria-selected="true">Pesan Baru</a>
                                </li>
                                <li class="nav-item w-50 text-center" role="presentation">
                                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#contacts" role="tab" aria-selected="false">Riwayat Pesan</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body h-100-card">
                            <div class="tab-content h-100" id="userProfileTabs">
                                <div class="tab-pane fade active show h-100 scroll-out" id="messages" role="tabpanel">
                                    <div class="h-100 nav py-0" id="messagesListContainer"></div>
                                </div>
                                <div class="tab-pane fade h-100 scroll-out" id="contacts" role="tabpanel">
                                    <div class="h-100 nav py-0" id="contactsListContainer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Contact and Message List End -->

            <div class="col h-100 d-none" id="chatView">
                <div class="flex-column h-100 w-100 d-none" id="chatMode">
                    <div class="card h-100 mb-2">
                        <div class="card-body d-flex flex-column h-100 w-100 position-relative">
                            <div class="d-flex flex-row align-items-center mb-3">
                                <div class="row g-0 sh-6 align-self-start" id="contactTitle">
                                    <div class="col-auto">
                                        <div class="sh-6 sw-6 d-inline-block position-relative">
                                            <img src="{{asset ('img/profile/profile-11.webp')}}" class="img-fluid rounded-xl border border-2 border-foreground profile" alt="thumb" />
                                            <i class="p-1 border border-1 border-foreground bg-primary position-absolute rounded-xl e-0 t-0 status"></i>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card-body d-flex flex-row pt-0 pb-0 pe-0 pe-0 ps-2 h-100 align-items-center justify-content-between">
                                            <div class="d-flex flex-column">
                                                <div class="name">Blaine Cottrell</div>
                                                <div class="text-small text-muted last">Last seen today 01:24</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="separator-light mb-3"></div>

                            @if(request('context_name'))
                            <div class="alert alert-primary d-flex align-items-center p-2 mb-3 mx-3" role="alert">
                                <div class="sw-5 sh-5 me-3">
                                    <img src="{{ asset(request('context_image')) }}" class="img-fluid rounded" alt="product">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="alert-heading fw-bold mb-0 text-primary">{{ request('context_name') }}</h6>
                                    <small class="mb-0 text-muted">Expired: {{ \Carbon\Carbon::parse(request('context_expired'))->format('d M H:i') }}</small>
                                </div>
                            </div>
                            @endif

                            <!-- Messages Start -->
                            <div class="h-100 mb-n2 scroll-out">
                                <div class="h-100 opacity-0" id="chatContentContainer"></div>
                            </div>
                            <!-- Messages End -->
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body p-0 d-flex flex-row align-items-center px-3 py-3">
                            <textarea class="form-control me-3 border-0 ps-2 py-2" placeholder="Message" rows="1" id="chatInput"></textarea>
                            <div class="d-flex flex-row">
                                <input class="file-upload d-none" type="file" accept="image/*" id="chatAttachmentInput" />
                                <button class="btn btn-icon btn-icon-only btn-outline-primary mb-1 rounded-xl" id="chatAttachButton" type="button">
                                    <i data-acorn-icon="attachment"></i>
                                </button>
                                <button class="btn btn-icon btn-icon-only btn-primary mb-1 rounded-xl ms-1" id="chatSendButton" type="button">
                                    <i data-acorn-icon="send"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Chat View End -->

                <div class="card flex-column h-100 w-100 bg-gradient-single-2 d-none" id="callMode">
                    <div class="bg-vertical-ornament-3 w-100 h-100 d-flex flex-column justify-content-between align-items-center">
                        <div class="card-body d-flex align-items-center flex-column flex-grow-1 w-100">
                            <div class="sw-10 mb-2 position-relative">
                                <img src="{{asset ('img/profile/profile-1.webp')}}" class="img-fluid rounded-xl border border-2 border-foreground profile" alt="thumb" />
                            </div>
                            <div class="name text-white">Blaine Cottrell</div>
                            <div class="text-white text-small time">00:00:00</div>
                        </div>
                        <div class="card-body d-flex flex-grow-0">
                            <button class="btn btn-foreground btn-icon btn-icon-only me-2">
                                <i data-acorn-icon="camera"></i>
                            </button>
                            <button class="btn btn-foreground btn-icon btn-icon-only me-2">
                                <i data-acorn-icon="mic-off"></i>
                            </button>
                            <button class="btn btn-foreground btn-icon" id="endCallButton">
                                <i data-acorn-icon="phone-off"></i>
                                <span>End Call</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact list template item start -->
    <template id="listItemTemplate">
        <a href="#" class="row w-100 d-flex flex-row g-0 sh-5 mb-2 nav-link p-0 contact-list-item">
            <div class="col-auto">
                <div class="sw-5 d-inline-block position-relative">
                    <img src="{{asset ('img/profile/profile-1.webp')}}" class="img-fluid rounded-xl border border-2 border-foreground" alt="thumb" id="contactImage" />
                    <i class="p-1 border border-1 border-foreground bg-primary position-absolute rounded-xl e-0 t-0" id="contactStatus"></i>
                </div>
            </div>
            <div class="col">
                <div class="card-body d-flex flex-row pt-0 pb-0 ps-3 pe-0 h-100 align-items-center justify-content-between">
                    <div class="d-flex flex-column">
                        <div class="mb-1" id="contactName"></div>
                        <div class="text-small text-muted clamp-line" data-line="1" id="contactLastSeen"></div>
                    </div>
                    <div class="d-flex">
                        <div class="badge bg-primary d-none" id="contactUnread">1</div>
                    </div>
                </div>
            </div>
        </a>
    </template>
    <!-- Contact list template item end -->

    <!-- Respond Container Template Start -->
    <template id="respondContainerTemplate">
        <div class="mb-2 card-content">
            <div class="row g-2">
                <div class="col-auto d-flex align-items-end">
                    <div class="sw-5 sh-5 mb-1 d-inline-block position-relative">
                        <img src="{{asset ('img/profile/profile-1.webp')}}" class="img-fluid rounded-xl chat-profile" alt="thumb" />
                    </div>
                </div>
                <div class="col d-flex align-items-end content-container"></div>
            </div>
        </div>
    </template>
    <!-- Respond Container Template End -->

    <!-- Respond Content Attachment Start -->
    <template id="respondAttachmentContentTemplate">
        <div class="d-inline-block sh-11 me-2 position-relative pb-4 rounded-md bg-separator-light text-alternate">
            <a href="" data-caption="cupcake.webp" class="lightbox h-100 attachment">
                <img src="{{asset ('img/product/small/product-4.webp')}}" class="h-100 rounded-md-top" />
            </a>
            <span class="position-absolute text-extra-small text-alternate opacity-75 b-2 e-2 time">17:20</span>
        </div>
    </template>
    <!-- Respond Content Attachment End -->

    <!-- Respond Content Text Start -->
    <template id="respondTextContentTemplate">
        <div class="bg-separator-light d-inline-block rounded-md py-3 px-3 pe-7 position-relative text-alternate">
            <span class="text">Hi, how is it going?</span>
            <span class="position-absolute text-extra-small text-alternate opacity-75 b-2 e-2 time">17:20</span>
        </div>
    </template>
    <!-- Respond Content Text End -->

    <!-- Message Container Template Start -->
    <template id="messageContainerTemplate">
        <div class="mb-2 card-content">
            <div class="row g-2">
                <div class="col-auto d-flex align-items-end order-1">
                    <div class="sw-5 sh-5 mb-1 d-inline-block position-relative">
                        <img src="{{asset ('img/profile/profile-2.webp')}}" class="img-fluid rounded-xl" alt="thumb" />
                    </div>
                </div>
                <div class="col d-flex justify-content-end align-items-end content-container"></div>
            </div>
        </div>
    </template>
    <!-- Message Container Template End -->

    <!-- Message Content Attachment Start -->
    <template id="messageAttachmentContentTemplate">
        <div class="d-inline-block sh-11 ms-2 position-relative pb-4 bg-primary rounded-md">
            <a href="" data-caption="cake.webp" class="lightbox h-100 attachment">
                <img src="{{asset ('img/product/small/product-4.webp')}}" class="h-100 rounded-md-top" />
            </a>
            <span class="position-absolute text-extra-small text-white opacity-75 b-2 s-2 time">19:26</span>
        </div>
    </template>
    <!-- Message Content Attachment End -->

    <!-- Message Content Text Start -->
    <template id="messageTextContentTemplate">
        <div class="bg-gradient-light d-inline-block rounded-md py-3 px-3 ps-7 text-white position-relative">
            <span class="text">Chocolate cake lollipop dessert.</span>
            <span class="position-absolute text-extra-small text-white opacity-75 b-2 s-2 time">19:20</span>
        </div>
    </template>
    <!-- Message Content Text End -->
</main>

@endsection

@push('scripts')

<script>
    const chatContactsUrl = "{{ route('dashboard.chat.contacts') }}";
    const chatSendUrl = "{{ route('dashboard.chat.send') }}";
    const chatMessagesUrl = "{{ route('dashboard.chat.messages', ['id' => ':id']) }}";
    const currentUserId = {{ auth()->id() }};
    const targetUser = @json($targetUser ?? null);
</script>

@endpush