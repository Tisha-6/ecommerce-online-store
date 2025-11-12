<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Card with Multiple Images</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      padding: 20px;
      margin: 0;
    }

    .card {
      background-color: #fff;
      max-width: 400px;
      margin: auto;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      padding: 20px;
    }

    .main-image {
      width: 100%;
      height: 250px;
      object-fit: contain;
      border: 1px solid #ddd;
      margin-bottom: 15px;
      border-radius: 5px;
    }

    .thumbnails {
      display: flex;
      gap: 10px;
      justify-content: center;
    }

    .thumbnails img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border: 2px solid transparent;
      border-radius: 4px;
      cursor: pointer;
      transition: border 0.2s;
    }

    .thumbnails img:hover,
    .thumbnails img.active {
      border-color: #0073e6;
    }

    .card h3 {
      margin: 15px 0 5px;
      font-size: 20px;
    }

    .card p {
      color: #666;
      font-size: 14px;
    }

    .price {
      color: #b12704;
      font-size: 18px;
      font-weight: bold;
      margin: 10px 0;
    }

    .btn {
      background-color: #ffa41c;
      color: white;
      padding: 10px;
      width: 100%;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    .btn:hover {
      background-color: #f08804;
    }
  </style>
</head>
<body>

<div class="card">
  <img src="https://via.placeholder.com/400x250?text=Main+Image" class="main-image" id="mainImage" alt="Main Product Image">

  <div class="thumbnails">
    <img src="../E-com_project/images/others/backet.jpg" onclick="changeImage(this)" class="active">
    <img src="../E-com_project/images/others/baggs.jpg" onclick="changeImage(this)">
    <img src="../E-com_project/images/others/fruit_backet.jpg" onclick="changeImage(this)">
    <img src="../E-com_project/images/others/backet.jpg" onclick="changeImage(this)">
  </div>

  <h3>Smartphone 5G 128GB</h3>
  <p>High-speed 5G phone with quad-camera and AMOLED display.</p>
  <div class="price">$699.99</div>
  <button class="btn">Add to Cart</button>
</div>


      <img src="https://via.placeholder.com/400x250?text=Main+Image" class="main-image" id="mainImage" alt="Main Product Image">

  <div class="thumbnails">
    <img src="../E-com_project/images/others/backet.jpg" onclick="changeImage(this)" class="active">
    <img src="../E-com_project/images/others/baggs.jpg" onclick="changeImage(this)">
    <img src="../E-com_project/images/others/fruit_backet.jpg" onclick="changeImage(this)">
    <img src="../E-com_project/images/others/backet.jpg" onclick="changeImage(this)">
  </div>

  <h3>Smartphone 5G 128GB</h3>
  <p>High-speed 5G phone with quad-camera and AMOLED display.</p>
  <div class="price">$699.99</div>
  <button class="btn">Add to Cart</button>
</div>


  <img src="https://via.placeholder.com/400x250?text=Main+Image" class="main-image" id="mainImage" alt="Main Product Image">

  <div class="thumbnails">
    <img src="../E-com_project/images/others/backet.jpg" onclick="changeImage(this)" class="active">
    <img src="../E-com_project/images/others/baggs.jpg" onclick="changeImage(this)">
    <img src="../E-com_project/images/others/fruit_backet.jpg" onclick="changeImage(this)">
    <img src="../E-com_project/images/others/backet.jpg" onclick="changeImage(this)">
  </div>

  <h3>Smartphone 5G 128GB</h3>
  <p>High-speed 5G phone with quad-camera and AMOLED display.</p>
  <div class="price">$699.99</div>
  <button class="btn">Add to Cart</button>
</div>


  <img src="https://via.placeholder.com/400x250?text=Main+Image" class="main-image" id="mainImage" alt="Main Product Image">

  <div class="thumbnails">
    <img src="../E-com_project/images/others/backet.jpg" onclick="changeImage(this)" class="active">
    <img src="../E-com_project/images/others/baggs.jpg" onclick="changeImage(this)">
    <img src="../E-com_project/images/others/fruit_backet.jpg" onclick="changeImage(this)">
    <img src="../E-com_project/images/others/backet.jpg" onclick="changeImage(this)">
  </div>

  <h3>Smartphone 5G 128GB</h3>
  <p>High-speed 5G phone with quad-camera and AMOLED display.</p>
  <div class="price">$699.99</div>
  <button class="btn">Add to Cart</button>
</div>





<script>
  function changeImage(element) {
    const mainImage = document.getElementById("mainImage");
    mainImage.src = element.src;

    document.querySelectorAll('.thumbnails img').forEach(img => {
      img.classList.remove('active');
    });
    element.classList.add('active');
  }
</script>

</body>
</html>
