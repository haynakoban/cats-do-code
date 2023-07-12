<?php include "header.php";?>

    <!-- Welcome Section -->
    <div class="container">
      <section
        id="myShowcase"
        class="
          d-flex
          p-5
          text-center text-sm-start
          align-items-center
          justify-content-between
        "
      >
        <div class="container">
          <div class="d-sm-flex align-items-center justify-content-between">
            <div class="animate__animated animate__fadeIn slow">
              <h1 class="display-5 fw-bold">
                Hi! <?php
if (isset($_SESSION["userData"])) {
    echo $_SESSION["userData"];
} else {
    echo 'First off';

}
?>, we believe that
                <span class="text-warning">CatsDoCode.</span>
              </h1>
              <p class="lead my-3">
                It's nice to see you here, buddy! Feel free to explore and check
                everything up and see what's in store for you. Always take care,
                mmkay?
              </p>
              <div class="animate__animated animate__bounce animate__delay-1s">
                <a href="#posts" class="btn btn-primary btn-lg mt-4"
                  >Start exploring!</a
                >
              </div>
            </div>
            <img
              class="
                img-fluid
                w-50
                d-none d-sm-block
                animate__animated animate__fadeIn animate__slower
              "
              src="./images/showcase.png"
              alt="showcase"
            />
          </div>
        </div>
      </section>
    </div>

    <!-- Cards -->
    <div class="container" id="posts">
        <div class="title">
            <h3 class="text-center py-4">Most Popular</h3>
        </div>
            <div class="cotainer d-flex justify-content-center">
            <div class="my-3">
                <a class="post" href="#">
                <div class="card mx-3" style="width: 20rem">
                    <img
                    src="./post_images/1.jpg"
                    class="card-img-top img-fluid"
                    alt="..."
                    />
                    <div class="card-body m-3">
                        <h6 class="card-subtitle mb-2 text-muted">2021-12-08 09:21:02</h6>
                        <h2 class="card-title">Aesthetics</h2>
                        <p class="card-text">
                        Nothing's perfect, the world's not perfect. But it's there for us, trying the best it can; that's what makes it so damn beautiful.
                        </p>
                        <hr />
                        <div class="float-start">
                            <i class="fas fa-comment fa-fw"></i>
                            896
                            <i class="fas fa-eye fa-fw ms-3"></i>
                            5648
                        </div>
                        <div class="float-end">
                            <i class="fas fa-share-alt fa-fw"></i>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <div class="my-3">
                <a class="post" href="#">
                <div class="card mx-3" style="width: 20rem">
                    <img
                    src="./post_images/1.jpg"
                    class="card-img-top img-fluid"
                    alt="..."
                    />
                    <div class="card-body m-3">
                        <h6 class="card-subtitle mb-2 text-muted">2021-11-18 12:00:22</h6>
                        <h2 class="card-title">Aesthetics</h2>
                        <p class="card-text">
                        Beauty is how you feel inside, and it reflects in your eyes. It is not something physical.
                        </p>
                        <hr />
                        <div class="float-start">
                            <i class="fas fa-comment fa-fw"></i>
                            896
                            <i class="fas fa-eye fa-fw ms-3"></i>
                            5648
                        </div>
                        <div class="float-end">
                            <i class="fas fa-share-alt fa-fw"></i>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <div class="my-3">
                <a class="post" href="#">
                <div class="card mx-3" style="width: 20rem">
                    <img
                    src="./post_images/1.jpg"
                    class="card-img-top img-fluid"
                    alt="..."
                    />
                    <div class="card-body m-3">
                        <h6 class="card-subtitle mb-2 text-muted">2021-10-19 09:20:24</h6>
                        <h2 class="card-title">Aesthetics</h2>
                        <p class="card-text">
                          Behind every exquisite thing that existed, there was something tragic.
                        </p>
                        <hr />
                        <div class="float-start">
                            <i class="fas fa-comment fa-fw"></i>
                            896
                            <i class="fas fa-eye fa-fw ms-3"></i>
                            5648
                        </div>
                        <div class="float-end">
                            <i class="fas fa-share-alt fa-fw"></i>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>

<?php include "footer.php";?>