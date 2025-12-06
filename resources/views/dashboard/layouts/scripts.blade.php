<!-- Vendor Scripts Start -->
<script src="{{asset ('js/vendor/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset ('js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset ('js/vendor/OverlayScrollbars.min.js')}}"></script>
<script src="{{asset ('js/vendor/autoComplete.min.js')}}"></script>
<script src="{{asset ('js/vendor/clamp.min.js')}}"></script>
<script src="{{asset ('icon/acorn-icons.js')}}"></script>
<script src="{{asset ('icon/acorn-icons-interface.js')}}"></script>
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
</script>

<!-- TinyMCE API -->
<script src="https://cdn.tiny.cloud/1/<Your_API></Your_API>/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>

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
    document.getElementById('dropifyInput').addEventListener('change', function(event) {
        let reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImage').src = e.target.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    });
</script>

<!-- Laravel PWA Service Worker Registration -->
<script type="text/javascript">
    // Initialize the service worker
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/serviceworker.js', {
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