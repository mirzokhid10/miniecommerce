<script>
    document.querySelectorAll('.variant-item').forEach(el => {
        el.addEventListener('click', function(e) {
            e.preventDefault();

            let price = parseFloat(this.dataset.price);

            // Example update total price
            document.getElementById("total_price").innerText = basePrice + price;
        });
    });
    console.log('hii');

    document.addEventListener("DOMContentLoaded", function() {

        const radios = document.querySelectorAll(".variant-radio");
        const totalEl = document.getElementById("total-price");

        const base = parseFloat(totalEl.dataset.base);

        function updateTotal() {
            let extra = 0;

            radios.forEach(radio => {
                if (radio.checked) {
                    const price = parseFloat(radio.dataset.price);
                    if (!isNaN(price)) {
                        extra += price;
                    }
                }
            });

            const final = base + extra;

            totalEl.textContent = "$ " + final.toFixed(2);
        }

        radios.forEach(radio => {
            radio.addEventListener("change", updateTotal);
        });

        updateTotal(); // initial load
    });

    document.addEventListener("DOMContentLoaded", function() {

        const radios = document.querySelectorAll(".variant-radio");
        const totalEl = document.getElementById("total-price");

        const qtyInput = document.querySelector(".number_area");
        const plusBtn = document.querySelector(".add");
        const minusBtn = document.querySelector(".sub");

        const base = parseFloat(totalEl.dataset.base);

        function updateTotal() {
            let extra = 0;

            radios.forEach(radio => {
                if (radio.checked) {
                    const price = parseFloat(radio.dataset.price);
                    if (!isNaN(price)) {
                        extra += price;
                    }
                }
            });

            const quantity = parseInt(qtyInput.value) || 1;

            const total = (base + extra) * quantity;

            totalEl.textContent = "$ " + total.toFixed(2);
        }

        // Variant change → update total
        radios.forEach(radio => {
            radio.addEventListener("change", updateTotal);
        });

        // Quantity + button
        plusBtn.addEventListener("click", function() {
            let q = parseInt(qtyInput.value) || 1;
            q++;
            qtyInput.value = q;
            updateTotal();
        });

        // Quantity − button
        minusBtn.addEventListener("click", function() {
            let q = parseInt(qtyInput.value) || 1;

            if (q > 1) {
                q--;
            }

            qtyInput.value = q;
            updateTotal();
        });

        // Manual input typing
        qtyInput.addEventListener("input", function() {
            let q = parseInt(qtyInput.value);

            if (isNaN(q) || q < 1) {
                q = 1;
            }

            qtyInput.value = q;
            updateTotal();
        });

        updateTotal(); // initial
    });
</script>