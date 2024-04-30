document.addEventListener('DOMContentLoaded', function () {
    const registerForm = document.getElementById('auth-form');

    registerForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const url = e.currentTarget.action;
        const errorBoxes = document.getElementsByClassName('error');

        for (let errorBox of errorBoxes) {
            errorBox.classList.add('hidden');
            errorBox.innerText = '';
        }

        fetch(url, {
            method: 'POST',
            body: new FormData(e.currentTarget),
        })
            .then((response) => {
                // 1. check response.ok
                if (response.ok) {
                    location.href = '/';
                    return;
                }

                return Promise.reject(response); // 2. reject instead of throw
            })
            .catch((response) => {
                console.log(response.status, response.statusText);
                // 3. get error messages, if any
                response.json().then((errors) => {
                    for (let errorBox of errorBoxes) {
                        if (errorBox.dataset.error in errors) {
                            errorBox.classList.remove('hidden');
                            errorBox.innerText = errors[errorBox.dataset.error];
                        }
                    }
                });
            });
    });
});