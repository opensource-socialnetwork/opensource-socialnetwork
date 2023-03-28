<script>
    // Allowing numbers, A-Z and a-z in username field
    $(document).ready(function () {
        var usernameField = $('#ossn-home-signup input[name="username"]');
        
        if (usernameField.length > 0) {
            usernameField.on('input', function () {
                var currentValue = $(this).val();
                var newValue = currentValue.replace(/[^a-zA-Z0-9]/g, '');
                $(this).val(newValue);
            });
        }
    });
</script>