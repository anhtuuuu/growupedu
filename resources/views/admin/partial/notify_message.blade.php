<?php if(Session::has('error')): ?>
<div class="callout callout-{{ Session::get('error') == 'success' ? 'success' : 'danger' }}">
    <h4>Thông báo!</h4>
    <p>{{ Session::has('message') ? Session::get('message') : '' }}</p>
</div>    
<?php Session::forget('message'); Session::forget('error'); endif; ?>
