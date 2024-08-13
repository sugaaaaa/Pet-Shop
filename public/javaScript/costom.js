document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('.add-to-wishlist-form');

    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(form);
            const url = form.action;

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Product successfully added to favorites');
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
});



document.getElementById('select-all').addEventListener('change', function (e) {
    let checkboxes = document.querySelectorAll('.select-item');
    checkboxes.forEach(checkbox => {
        checkbox.checked = e.target.checked;
    });
});

document.getElementById('order-selected').addEventListener('click', function () {
    let form = document.getElementById('order-form');
    form.method = 'POST'; // Ensure the method is POST
    form.submit();
});
