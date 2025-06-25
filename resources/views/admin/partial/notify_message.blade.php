<?php if(isset($error) && !empty($error)): ?>
<div class="callout callout-{{ $error == 'success' ? 'success' : 'danger' }}">
    <h4>Thông báo!</h4>
    <p>{{ isset($message) ? $message : '' }}</p>
</div>
<?php endif; ?>
