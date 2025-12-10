<!-- Vendor Scripts Start -->
<script src="{{asset ('js/vendor/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset ('js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset ('js/vendor/OverlayScrollbars.min.js')}}"></script>
<script src="{{asset ('js/vendor/autoComplete.min.js')}}"></script>
<script src="{{asset ('js/vendor/clamp.min.js')}}"></script>
<script src="{{asset ('js/vendor/jquery.barrating.min.js')}}"></script>
<script src="{{asset ('icon/acorn-icons.js')}}"></script>
<script src="{{asset ('icon/acorn-icons-interface.js')}}"></script>
<script src="{{asset ('js/vendor/Chart.bundle.min.js')}}"></script>
<script src="{{asset ('js/vendor/chartjs-plugin-datalabels.js')}}"></script>
<script src="{{asset ('js/vendor/chartjs-plugin-rounded-bar.min.js')}}"></script>
<script src="{{asset ('js/vendor/glide.min.js')}}"></script>
<script src="{{asset ('js/vendor/intro.min.js')}}"></script>
<script src="{{asset ('js/vendor/select2.full.min.js')}}"></script>
<script src="{{asset ('js/vendor/plyr.min.js')}}"></script>
<script src="{{asset ('js/cs/responsivetab.js')}}"></script>
<script src="{{asset ('js/vendor/baguetteBox.min.js')}}"></script>
<script src="{{asset ('js/vendor/autosize.min.js')}}"></script>
<script src="{{asset ('js/vendor/moment-with-locales.min.js')}}"></script>

<!-- Vendor Scripts End -->

<!-- Template Base Scripts Start -->
<script src="{{asset ('js/base/helpers.js')}}"></script>
<script src="{{asset ('js/base/globals.js')}}"></script>
<script src="{{asset ('js/base/nav.js')}}"></script>
<script src="{{asset ('js/base/search.js')}}"></script>
<script src="{{asset ('js/base/settings.js')}}"></script>
<!-- Template Base Scripts End -->
<!-- Page Specific Scripts Start -->
<script src="{{asset ('js/cs/glide.custom.js')}}"></script>
<script src="{{asset ('js/pages/blog.home.js')}}"></script>
<script src="{{asset ('js/cs/charts.extend.js')}}"></script>
<script src="{{asset ('js/pages/dashboard.default.js')}}"></script>
<script src="{{asset ('js/pages/dashboard.visual.js')}}"></script>
<script src="{{asset ('js/common.js')}}"></script>
<script src="{{asset ('js/scripts.js')}}"></script>
<script src="{{asset ('js/plugins/carousels.js')}}"></script>
<script src="{{asset ('js/pages/blog.detail.js')}}"></script>
@vite(['resources/js/app.js'])
<script src="{{asset ('js/apps/chat.js')}}"></script>

<script>
    const chatJsonUrl = "{{ asset('json/chat.json') }}";
    const chatContactsUrl = "{{ route('dashboard.chat.contacts') }}";
    const chatMessagesUrl = "{{ route('dashboard.chat.messages', ':id') }}";
    const chatSendUrl = "{{ route('dashboard.chat.send') }}";
    const currentUserId = {{ Auth::check() ? Auth::id() : 'null' }};
</script>

<!-- TinyMCE API -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        src = "https://cdn.tiny.cloud/1/YOUR_API/tinymce/8/tinymce.min.js"
        referrerpolicy = "origin"
        crossorigin = "anonymous"
    });
</script>
<!-- Dropify JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $('.dropify').dropify({
        messages: {
            default: 'Drag or drop your image',
            replace: 'Drag or drop to replace',
            remove: 'Remove image',
            error: 'Oops, invalid file!'
        },
        tpl: {
            message: `
                <div class="dropify-message">
                    <img src="{{ asset('img/icon/drop-file.png') }}" alt="Upload Icon" style="width: 100px; margin-bottom: 5px;">
                    <p>Drag or drop your image</p>
                </div>
            `
        }
    });
</script>

<!-- Preview Profile -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('dropifyInput');
        const preview = document.getElementById('previewImage');

        if (input && preview) {
            input.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            });
        }
    });
</script>

<script>
    document.addEventListener('click', function(e) {
        const a = e.target.closest('a[href="#"]');
        if (a) e.preventDefault();
    });
</script>

<!-- Laravel PWA Service Worker Registration -->
<script type="text/javascript">
    // Initialize the service worker
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register("{{asset ('serviceworker.js')}}", {
            scope: '.'
        }).then(function(registration) {
            // Registration was successful
            console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration.scope);
        }, function(err) {
            // registration failed :(
            console.log('Laravel PWA: ServiceWorker registration failed: ', err);
        });
    }
</script>

<!-- Page Specific Scripts End -->