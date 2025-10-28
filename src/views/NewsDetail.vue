<template>
  <div>
    <div class="d-flex justify-content-center py-3">
      <p class="btn btn-sm bg-secondary mr-4 text-white fw-bold" 
      @click="home()" v-if="!tokenStatus">
        Home
      </p>
      <p class="btn btn-sm bg-warning text-dark fw-bold" 
      @click="login()" v-if="!tokenStatus">
      Login
      </p>
      <p class="btn btn-sm bg-warning text-dark fw-bold" 
      @click="logout()" v-if="tokenStatus">
      Logout
      </p>
    </div>
    <main>
      <!-- About US Start -->
      <div class="about-area">
        <div class="container">
          <!-- Hot Aimated News Tittle-->
          <div class="row">
            <div class="col-lg-12">
              <div class="trending-tittle">
                <strong>Trending now</strong>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-8">
              <!-- Trending Tittle -->
              <div class="about-right mb-90">
                <div class="about-img">
                  <img :src="posts.image" alt="" />
                </div>
                <div class="section-tittle mb-30 pt-30">
                  <h3>{{ posts.title }}</h3>
                </div>
                <div class="about-prea">
                  <iframe
                    :src="posts.video"
                    frameborder="0"
                    class="control"
                  ></iframe>
                  <p class="about-pera1 mb-25">
                    <!-- {{posts.country}} -->
                  </p>
                  <p class="about-pera1 mb-25">
                    {{ posts.description }}
                  </p>
                </div>
                <div class="social-share pt-30">
                  <div class="section-tittle">
                    <i class="fa-solid fa-eye mt-1 mr-1"></i>
                    <span>{{ viewCount }}</span>
                  </div>
                </div>
              </div>
              <!-- From -->
              <div class="row">
                <div class="col-lg-8">
                  <div class="form-group">
                    <button
                      type="submit"
                      class="button button-contactForm boxed-btn mb-5"
                      @click="back()"
                    >
                      Back
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <!-- Section Tittle -->
              <div class="section-tittle mb-40">
                <h3>Follow Us</h3>
              </div>
              <!-- Flow Socail -->
              <div class="single-follow mb-45">
                <div class="single-box">
                  <div class="follow-us d-flex align-items-center">
                    <div class="follow-social">
                      <a href="#"
                        ><img src="assets/img/news/icon-fb.png" alt=""
                      /></a>
                    </div>
                    <div class="follow-count">
                      <span>8,045</span>
                      <p>Fans</p>
                    </div>
                  </div>
                  <div class="follow-us d-flex align-items-center">
                    <div class="follow-social">
                      <a href="#"
                        ><img src="assets/img/news/icon-tw.png" alt=""
                      /></a>
                    </div>
                    <div class="follow-count">
                      <span>8,045</span>
                      <p>Fans</p>
                    </div>
                  </div>
                  <div class="follow-us d-flex align-items-center">
                    <div class="follow-social">
                      <a href="#"
                        ><img src="assets/img/news/icon-ins.png" alt=""
                      /></a>
                    </div>
                    <div class="follow-count">
                      <span>8,045</span>
                      <p>Fans</p>
                    </div>
                  </div>
                  <div class="follow-us d-flex align-items-center">
                    <div class="follow-social">
                      <a href="#"
                        ><img src="assets/img/news/icon-yo.png" alt=""
                      /></a>
                    </div>
                    <div class="follow-count">
                      <span>8,045</span>
                      <p>Fans</p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- New Poster -->
              <div class="news-poster d-none d-lg-block">
                <!-- <img src="assets/img/news/blog.jpg" alt="" /> -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- About US End -->
    </main>
  </div>
</template>

<script src="../js/NewsDetail.js"></script>
