<!DOCTYPE html>
<html lang="en">

<?php include 'includes/head.php'; ?>

<body class="service-details-page">

  <?php include 'includes/details-nav.php'; ?>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Service Details</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index">Home</a></li>
            <li class="current">Service Details</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Service Details Section -->
    <section id="service-details" class="service-details section">

      <div class="container">

        <div class="row gy-5">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">

            <div class="service-box">
              <h4>Our Services</h4>
              <div class="services-list">
                <a href="#" class="active"><i class="bi bi-arrow-right-circle"></i><span>Comprehensive Assessment</span></a>
                <a href="#"><i class="bi bi-arrow-right-circle"></i><span>College & Program Matching</span></a>
                <a href="#"><i class="bi bi-arrow-right-circle"></i><span>Application & Essay Support</span></a>
                <a href="#"><i class="bi bi-arrow-right-circle"></i><span>Transition Preparation</span></a>
              </div>
            </div><!-- End Services List -->

            <div class="service-box">
              <h4>Download Catalog</h4>
              <div class="download-catalog">
                <a href="#"><i class="bi bi-filetype-pdf"></i><span>Catalog PDF</span></a>
                <a href="#"><i class="bi bi-file-earmark-word"></i><span>Catalog DOC</span></a>
              </div>
            </div><!-- End Services List -->

            <div class="help-box d-flex flex-column justify-content-center align-items-center">
              <i class="bi bi-headset help-icon"></i>
              <h4>Have a Question?</h4>
              <p class="d-flex align-items-center mt-2 mb-0"><i class="bi bi-telephone me-2"></i> <span>+254 123-456-7890</span></p>
              <p class="d-flex align-items-center mt-1 mb-0"><i class="bi bi-envelope me-2"></i> <a href="mailto:info@neurohaven.com">info@neurohaven.com</a></p>
            </div>

          </div>

          <div class="col-lg-8 ps-lg-5" data-aos="fade-up" data-aos-delay="200">
            <img src="assets/img/services/strategy.svg" alt="" class="img-fluid services-img">
            <h3>How We Help Students Succeed</h3>
            <p>
              At NeuroHaven, we offer a comprehensive suite of services designed to empower students—especially those with learning differences—to thrive in their transition to college. Our four-part plan ensures every student receives the personalized support they need.
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i> <span><strong>Comprehensive Assessment:</strong> We evaluate your academic profile, interests, and learning needs to create a strong foundation for your college journey.</span></li>
              <li><i class="bi bi-check-circle"></i> <span><strong>College & Program Matching:</strong> Our advisors research and recommend colleges and programs that align with your goals and learning style.</span></li>
              <li><i class="bi bi-check-circle"></i> <span><strong>Application & Essay Support:</strong> From application strategy to essay brainstorming and editing, we help you present your best self.</span></li>
              <li><i class="bi bi-check-circle"></i> <span><strong>Transition Preparation:</strong> We offer resources and coaching to ensure you’re ready—academically, socially, and emotionally—for college life.</span></li>
            </ul>
            <p>
              Our individualized approach and expert guidance minimize stress for students and families, making the college planning process clear, manageable, and rewarding.
            </p>
            <p>
              Ready to take the next step? <a href="#contact">Contact us today</a> to schedule a free consultation and discover how NeuroHaven can help you achieve your college dreams.
            </p>
          </div>

        </div>

      </div>

    </section><!-- /Service Details Section -->

  </main>

  <?php include 'includes/footer.php'; ?>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <?php include 'includes/scripts.php'; ?>

</body>

</html>