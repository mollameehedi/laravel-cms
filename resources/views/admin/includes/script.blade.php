 <!-- Library Bundle Script -->
 <script src="{{ asset('assets') }}/js/core/libs.min.js"></script>
 <!-- Plugin Scripts -->
 <!-- Tour plugin Start -->
 <script src="{{ asset('assets') }}/vendor/sheperd/dist/js/sheperd.min.js"></script>
 <script src="{{ asset('assets') }}/js/plugins/tour.js" defer></script>

 @yield('script')
 <!-- Flatpickr Script -->
 <script src="{{ asset('assets') }}/vendor/flatpickr/dist/flatpickr.min.js"></script>
 <script src="{{ asset('assets') }}/js/plugins/flatpickr.js" defer></script>
 <!-- Slider-tab Script -->
 <script src="{{ asset('assets') }}/js/plugins/slider-tabs.js"></script>
 <!-- Select2 Script -->
 <script src="{{ asset('assets') }}/js/plugins/select2.js" defer></script>

 <!-- Lodash Utility -->
 <script src="{{ asset('assets') }}/vendor/lodash/lodash.min.js"></script>
 <!-- Utilities Functions -->
 <script src="{{ asset('assets') }}/js/iqonic-script/utility.js"></script>
 <!-- Settings Script -->
 <script src="{{ asset('assets') }}/js/iqonic-script/setting.js"></script>
 <!-- Settings Init Script -->
 <script src="{{ asset('assets') }}/js/setting-init.js"></script>
 <!-- External Library Bundle Script -->
 <script src="{{ asset('assets') }}/js/core/external.min.js"></script>
 <!-- Widgetchart Script -->
 <script src="{{ asset('assets') }}/js/charts/widgetcharts.js?v=2.0.0" defer></script>
 <!-- Dashboard Script -->
 <script src="{{ asset('assets') }}/js/charts/dashboard.js?v=2.0.0" defer></script>
 <script src="{{ asset('assets') }}/js/charts/alternate-dashboard.js?v=2.0.0" defer></script>
 <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
 {!! Toastr::message() !!}
 <script>
     @if (count($errors) > 0)
         @foreach ($errors->all() as $error)
             toastr.error("{{ $error }}");
         @endforeach
     @endif
 </script>
 <!-- Hopeui Script -->
 <script src="{{ asset('assets') }}/js/hope-ui.js?v=2.0.0" defer></script>
 <script src="{{ asset('assets') }}/js/hope-uipro.js?v=2.0.0" defer></script>
 <script src="{{ asset('assets') }}/js/sidebar.js?v=2.0.0" defer></script>
