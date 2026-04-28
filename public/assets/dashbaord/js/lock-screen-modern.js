(function () {
    // 1. Idle Timer Logic (Global)
    let idleTime = 0;
    const config = window.LockScreenConfig || {
        idle_limit: 60,
        lock_route: "#",
    };
    const idleLimit = config.idle_limit;

    function resetTimer() {
        idleTime = 0;
    }

    // Only start timer if we are authenticated and not already on the lock screen
    if (!window.location.href.includes("lock-screen")) {
        setInterval(() => {
            idleTime++;
            if (idleTime >= idleLimit) {
                window.location.href = config.lock_route;
            }
        }, 1000);

        window.onload = resetTimer;
        window.onmousemove = resetTimer;
        window.onmousedown = resetTimer;
        window.ontouchstart = resetTimer;
        window.onclick = resetTimer;
        window.onkeypress = resetTimer;
    }

    // 2. Unlock AJAX Handler (Lock Screen Only)
    $(document).ready(function () {
        const lockForm = $("#lock-form");
        if (lockForm.length > 0) {
            const passwordInput = $("#lock-password");
            const errorEl = $("#lock-error");
            const submitBtn = $("#unlock-btn");
            const data = window.LockScreenData || {};

            lockForm.on("submit", function (e) {
                e.preventDefault();

                const password = passwordInput.val();

                // Reset state
                errorEl.addClass("d-none").text("");
                passwordInput.removeClass("is-invalid");

                if (!password) {
                    passwordInput.addClass("is-invalid");
                    errorEl
                        .removeClass("d-none")
                        .text(data.messages.failed || "Password is required");
                    return;
                }

                // Show loading
                const originalBtnHtml = submitBtn.html();
                submitBtn
                    .prop("disabled", true)
                    .html(
                        '<i class="la la-spinner la-spin"></i> ' +
                            (data.labels.unlocking || "Unlocking..."),
                    );

                $.ajax({
                    url: data.routes.unlock,
                    method: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        password: password,
                    },
                    success: function (response) {
                        if (response.status) {
                            // Smooth transition
                            window.location.replace(
                                response.redirect || data.routes.dashboard,
                            );
                        } else {
                            submitBtn
                                .prop("disabled", false)
                                .html(originalBtnHtml);
                            passwordInput.addClass("is-invalid");
                            errorEl
                                .removeClass("d-none")
                                .text(response.message || data.messages.failed);
                        }
                    },
                    error: function (xhr) {
                        submitBtn.prop("disabled", false).html(originalBtnHtml);
                        let errorMsg = data.messages.failed || "Error";
                        if (xhr.status === 422) {
                            errorMsg =
                                xhr.responseJSON.message ||
                                data.messages.failed;
                        }
                        passwordInput.addClass("is-invalid");
                        errorEl.removeClass("d-none").text(errorMsg);
                    },
                });
            });

            // Clear error on typing
            passwordInput.on("input", function () {
                passwordInput.removeClass("is-invalid");
                errorEl.addClass("d-none");
            });
        }
    });
})();
