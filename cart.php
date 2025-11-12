<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Cart</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
  <div class="container">
    <h1>Your Shopping Cart</h1>
    <table class="table table-bordered" id="cart-table">
      <thead>
        <tr>
          <th>Product</th>
          <th>Price (₹)</th>
          <th>Quantity</th>
          <th>Total</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
    <h3 id="grand-total"></h3>
    <button class="btn btn-success">Checkout</button>
  </div>

  <script>
    function loadCart() {
      return JSON.parse(localStorage.getItem("cart")) || [];
    }

    function saveCart(cart) {
      localStorage.setItem("cart", JSON.stringify(cart));
    }

    function renderCart() {
      const cart = loadCart();
      const tbody = document.querySelector("#cart-table tbody");
      tbody.innerHTML = "";
      let total = 0;

      cart.forEach((item, index) => {
        const row = document.createElement("tr");
        const itemTotal = item.price * item.quantity;
        total += itemTotal;

        row.innerHTML = `
          <td>${item.name}</td>
          <td>${item.price}</td>
          <td>
            <input type="number" min="1" value="${item.quantity}" class="form-control w-50" data-index="${index}">
          </td>
          <td>${itemTotal}</td>
          <td><button class="btn btn-danger btn-sm remove" data-index="${index}">Remove</button></td>
        `;
        tbody.appendChild(row);
      });

      document.getElementById("grand-total").textContent = "Grand Total: ₹" + total;

      // Quantity change
      document.querySelectorAll('input[type="number"]').forEach(input => {
        input.addEventListener("change", e => {
          const cart = loadCart();
          const index = e.target.dataset.index;
          cart[index].quantity = parseInt(e.target.value);
          saveCart(cart);
          renderCart();
        });
      });

      // Remove button
      document.querySelectorAll(".remove").forEach(button => {
        button.addEventListener("click", e => {
          const cart = loadCart();
          const index = e.target.dataset.index;
          cart.splice(index, 1);
          saveCart(cart);
          renderCart();
        });
      });
    }

    renderCart();
  </script>
</body>
</html>
