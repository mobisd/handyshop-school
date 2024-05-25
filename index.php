<?php
session_start();
include("admin/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Handy Hub</title>
    <link rel="icon" type="image/x-icon" href="assets/logo/Transparent_Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body data-bs-spy="scroll" data-bs-target="#navbarNav" data-bs-offset="70">

<?php
$cartCount = isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0;
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <img src="/assets/logo/Transparent_Logo.png" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
        <a class="navbar-brand" href="#">HandyHub</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#sales">Sales Highlights</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#phoneFilter">Our Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#serviceHighlights">Service Highlights</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
            </ul>
        </div>
        <div class="navbar-nav ms-auto">
            <?php if (isset($_SESSION['id'])): ?>
                <div class="nav-item profile-container">
                    <?php if ($_SESSION['username'] == 'admin'): ?>
                        <a href="admin/dashboard.php" class="btn btn-danger ml-3">Dashboard</a>
                    <?php endif; ?>
                    <div class="cart-container">
                        <a href="/admin/cart/cart.php" class="cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                            <span id="cartCount"><?php echo $_SESSION['cart_count']; ?></span>
                        </a>
                    </div>
                    <img src="<?php echo $_SESSION['profile_picture']; ?>" alt="Profile" class="profile-picture" onclick="toggleDropdown()">
                    <span class="navbar-text ms-2"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'User'; ?></span>
                    <div class="profile-dropdown" id="profileDropdown">
                        <a href="profile.php">Edit Profile</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <a class="btn btn-custom me-2" href="admin/login/login.php">Login</a>
                <a class="btn btn-custom" href="admin/signup/signup.php">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

    <div id="home" class="container mt-4">
      <div class="row d-flex align-items-stretch">
        <div class="col-md-8">
          <div
            id="carouselExampleIndicators"
            class="carousel slide"
            data-bs-ride="carousel"
          >
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img
                  src="assets/imgs/Carousel1.jpg"
                  class="d-block w-100"
                  alt="..."
                />
              </div>
              <div class="carousel-item">
                <img
                  src="assets/imgs/Carousel2.jpg"
                  class="d-block w-100"
                  alt="..."
                />
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
  <div class="highlight-box-top-deal">
    <img src="assets/imgs/Top Deal.png" class="product-image-top-deal" alt="Top Deal" />
    <div class="py-2"></div>
    <p class="fs-2 fw-bolder">Top Deal</p>
  </div>
</div>
      </div>
    </div>

    <div id="sales" class="container mt-4">
      <p class="fs-1 fw-bolder">Sales Highlights</p>
      <div class="row">
          <div class="col-md-3">
              <div class="card sale-highlight-card">
                  <div class="discount-tag">-29%</div>
                  <img src="assets/produkte/apple/Iphone_12_Pro_Goldpng.png" class="card-img-top" alt="Product Image">
                  <div class="card-body">
                      <h5 class="card-title text-center">iPhone 12 Pro in Gold</h5>
                      <p class="price text-center">€450.00 <span class="original-price">€516.00</span></p>
                      <button class="add-to-cart" data-product-id="6">In den Warenkorb</button>

                  </div>
              </div>
          </div>
          <div class="col-md-3">
            <div class="card sale-highlight-card">
                <div class="discount-tag">-40%</div>
                <img src="assets/produkte/samsung/Galaxy_A15_128gb_BlueBlack.png" class="card-img-top" alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title text-center">Galaxy A15 in Blue Black mit 128GB</h5>
                    <p class="price text-center">€90.00 <span class="original-price">€199.00</span></p>
                    <button class="add-to-cart" data-product-id="26">In den Warenkorb</button>

                </div>
            </div>
        </div>
        <div class="col-md-3">
          <div class="card sale-highlight-card">
              <div class="discount-tag">-10%</div>
              <img src="assets/produkte/oneplus/OnePlus_Nord_3_128gb_Tempest_Gray.png" class="card-img-top" alt="Product Image">
              <div class="card-body">
                  <h5 class="card-title text-center">OnePlus Nord 3 mit 128GB in Tempest Gray</h5>
                  <p class="price text-center">€420.00 <span class="original-price">€450.00</span></p>
                  <button class="add-to-cart" data-product-id="23">In den Warenkorb</button>

              </div>
          </div>
      </div>
      <div class="col-md-3">
        <div class="card sale-highlight-card">
            <div class="discount-tag">-5%</div>
            <img src="assets/produkte/huawei/Huawei_Nova_10SE_128gb_Silber.png" class="card-img-top" alt="Product Image">
            <div class="card-body">
                <h5 class="card-title text-center">Huawei Nova 10 SE in Silber mit 128GB Speicher</h5>
                <p class="price text-center">€380.00 <span class="original-price">€400.00</span></p>
                <button class="add-to-cart" data-product-id="15">In den Warenkorb</button>

            </div>
        </div>
    </div>
      </div>
  </div>


  <div class="container mt-4" id="phoneFilter">
  <p class="fs-1 fw-bolder">Our Products</p>
  <div class="row">
    <div class="col-3">
      <div class="highlight-box" onclick="changeBrand('all')">
        <img src="/assets/logo/Transparent_Logo.png" class="product-image" alt="All">
        <p>All</p>
      </div>
    </div>
    <div class="col-3">
      <div class="highlight-box" onclick="changeBrand('apple')">
        <img src="assets/imgs/Apple.png" class="product-image" alt="Apple">
        <p>Apple</p>
      </div>
    </div>
    <div class="col-3">
      <div class="highlight-box" onclick="changeBrand('oneplus')">
        <img src="assets/imgs/oneplus-icon-2048x2048-4hadrx88.png" class="product-image" alt="OnePlus">
        <p>OnePlus</p>
      </div>
    </div>
    <div class="col-3">
      <div class="highlight-box" onclick="changeBrand('samsung')">
        <img src="assets/imgs/Samsung_Logo.svg.png" class="product-image" alt="Samsung">
        <p>Samsung</p>
      </div>
    </div>
    <div class="col-3">
      <div class="highlight-box" onclick="changeBrand('huawei')">
        <img src="assets/imgs/758px-Huawei-Logo.svg.png" class="product-image" alt="Huawei">
        <p>Huawei</p>
      </div>
    </div>
    <div class="col-3">
      <div class="highlight-box" onclick="changeBrand('xiaomi')">
        <img src="assets/imgs/xiaomi_logo_icon_144724.png" class="product-image" alt="Xiaomi">
        <p>Xiaomi</p>
      </div>
    </div>
  </div>
</div>

  

    <div class="container mt-4" id="phonesSection">
      <p class="fs-1 fw-bolder"></p>
    </div>

    <div class="album py-5">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php 
          if (isset($_POST['filter'])){
            $filter = $_POST['filter'];
            if ($filter == "0"){
              $query = "select * from produkte";
            }else{
              $query = "select * from produkte where marke = '$filter'";
            }
          }else{
            $query = "select * from produkte";
          }
          $result = mysqli_query($db, $query);
          while ($row = mysqli_fetch_object($result)){
        ?>
        <div class="modal" id="details<?php echo "$row->id"; ?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Produkt Details</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body row">
              <div class="col">
                <ul style="list-style-type:none;">
                  <li><span style="font-weight: bold;">Name:</span> <?php echo "$row->name"; ?></li>
                  <li><span style="font-weight: bold;">Beschreibung:</span><?php echo "$row->beschreibung"; ?></li>
                  <li><span style="font-weight: bold;">Kategorie:</span> <?php echo "$row->kategorie"; ?></li>
                  <li><span style="font-weight: bold;">Pres:</span> <?php echo "$row->preis"; ?></li>
                </ul>
              </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer" id="scrollspyHeading4">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>

        </div>
    </div>
  </div>
        <?php
          }
        ?>
      </div>
    </div>
  </div>

  <section>
  <div class="container mt-5" id="serviceHighlights">
    <p class="text-left mb-4 fs-1 fw-bold text-dark">Unsere Service Highlights</p>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-headset service-icon"></i>
                <p class="service-title fs-5 text-dark fw-bold">Rundum-Betreuung</p>
                <p class="service-description">Bei Unklarheiten erhalten Sie von unseren Experten schnelle, ausführliche Antworten auf Ihre Fragen.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-tags service-icon"></i>
                <p class="service-title fs-5 text-dark fw-bold">TOP KONDITIONEN</p>
                <p class="service-description">Wöchentlich neue Angebote aller premium Marken zu Top Konditionen.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-tools service-icon"></i>
                <p class="service-title fs-5 text-dark fw-bold">REPARATURSERVICE</p>
                <p class="service-description">Unsere Reparaturspezialisten kümmern sich direkt vor Ort um Ihre defekten Smartphones aller Marken.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-shipping-fast service-icon"></i>
                <p class="service-title fs-5 text-dark fw-bold">RÜCKSENDUNG</p>
                <p class="service-description">Im Fall der Fälle: In Garantiefällen übernehmen wir natürlich die Kosten für die Rücksendung.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-store service-icon"></i>
                <p class="service-title fs-5 text-dark fw-bold">24/7-SHOPPEN</p>
                <p class="service-description">Sparen Sie sich den Stress mit Öffnungs- oder Wartezeiten und entdecken Sie unser Sortiment im Onlineshop.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-credit-card service-icon"></i>
                <h3 class="service-title fs-5 text-dark fw-bold">Zahlungsarten</h3>
                <p class="service-description">Ob PayPal, Kreditkarte, Sofortüberweisung, etc. – wählen Sie die für Sie ideale Zahlungsmethode.</p>
            </div>
        </div>
    </div>
</div>

  </section>

  <section id="contact" class="maps-and-contact">
            <div class="container">
            <p class="text-left mb-4 fs-1 fw-bold text-dark">Contact Us</p>
                <div class="row">
                    <div class="col-md-6 px-3 py-3">
                        <div id="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d21268.059681924922!2d16.35243797431641!3d48.2161023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476d070f3319a9d1%3A0x16943665944694e!2sSex%20Shop%20-%20Czerningasse%2029!5e0!3m2!1sen!2sus!4v1715589055275!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form class="contact-form">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" id="name" class="form-control" placeholder="Enter your name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" id="email" class="form-control" placeholder="Enter your email">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message:</label>
                                <textarea id="message" class="form-control" rows="5" placeholder="Type your message here"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
         </section>



        <footer class="footer">
        <div class="container py-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="#" class="nav-link px-2">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2">Features</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2">Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2">About</a></li>
            </ul>
            <div class="text-center mb-3">
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <p class="text-center text-body-primary">© 2024 Company, SCHMID MORITZ WÆH</p>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
function toggleDropdown() {
    var dropdown = document.getElementById("profileDropdown");
    if (dropdown.style.display === "block") {
        dropdown.style.display = "none";
    } else {
        dropdown.style.display = "block";
    }
}

window.onclick = function(event) {
    if (!event.target.matches('.profile-picture')) {
        var dropdowns = document.getElementsByClassName("profile-dropdown");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.style.display === "block") {
                openDropdown.style.display = "none";
            }
        }
    }
}

function changeBrand(brand) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("phonesSection").innerHTML = this.responseText;
        attachAddToCartEvent();
    }
    xhttp.open("POST", "filter.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("brand=" + brand);
}

function attachAddToCartEvent() {
    document.querySelectorAll('.add-to-cart').forEach(function(button) {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;

            fetch('admin/cart/add_to_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'product_id=' + productId
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('cartCount').textContent = data;
            })
            .catch(error => console.error('Error:', error));
        });
    });
}

document.addEventListener('DOMContentLoaded', attachAddToCartEvent);
</script>

</body>
</html>