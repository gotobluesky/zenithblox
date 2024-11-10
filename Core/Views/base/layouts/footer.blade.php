  @php
    $settings_details = getGeneralSettingsDetails(); 
  @endphp
  <footer class="footer">
     {!! xss_clean($settings_details['copyright_text']) !!}
  </footer>
