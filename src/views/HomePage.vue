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
    <!-- Whats New Start -->
    <section class="whats-news-area pt-50 pb-20">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div
              class="row d-flex justify-content-between justify-center align-items-center"
            >
              <div class="col-lg-2 col-md-2">
                <div class="section-tittle mb-30">
                  <h3>Whats New</h3>
                </div>
              </div>
              <div class="col-lg-7 col-md-7">
                <div class="properties__button">
                  <!--Nav Button  -->
                  <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <a
                        class="nav-item nav-link active"
                        id="nav-home-tab"
                        data-toggle="tab"
                        href="details.htmlnav-home"
                        role="tab"
                        aria-controls="nav-home"
                        aria-selected="true"
                        @click="categoryBar('')"
                        >All</a
                      >

                      <a
                        class="nav-item nav-link"
                        id="nav-profile-tab"
                        data-toggle="tab"
                        href="details.htmlnav-profile"
                        role="tab"
                        aria-controls="nav-profile"
                        aria-selected="false"
                        v-for="(category, index) in categoryLists"
                        :key="index"
                        @click="categoryBar(category.id)"
                      >
                        {{ category.title }}
                      </a>
                    </div>
                  </nav>
                  <!--End Nav Button  -->
                </div>
              </div>
              <div
                class="col-lg-3 col-md-3 mb-4 d-flex justify-center align-items-center"
              >
                <div class="search-box">
                  <input
                    v-model="searchKey"
                    v-on:keyup.enter="searchFunction()"
                    type="text"
                    placeholder="Search"
                  />
                </div>
                <i
                  @click="searchFunction()"
                  class="fas fa-search special-tag ml-2"
                ></i>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <!-- Nav Card -->
                <div class="tab-content" id="nav-tabContent">
                  <!-- card one -->
                  <div
                    class="tab-pane fade show active"
                    id="nav-home"
                    role="tabpanel"
                    aria-labelledby="nav-home-tab"
                  >
                    <div class="whats-news-caption">
                      <div v-if="!tokenStatus">
                        <h4 class="text-danger d-flex justify-content-center p-5" style="background-color: lightblue;">
                          You don't have permission for that data
                        </h4>
                      </div>

                      <div v-else>
                        <div class="row">
                          <div class="mx-auto mt-5 d-flex align-items-center"  style="height: 350px"
                            v-if="postLists.length == 0"  >

                            <h1
                              class="text-danger"
                              style="
                                background-color: #23232310;
                                padding: 10px 15px;
                                border-radius: 10px;
                              "
                            >
                              There is no data!
                            </h1>
                          </div>

                          <div
                            class="col-lg-4 col-md-4"
                            v-else-if="postLists.length != 0"
                            v-for="(post, index) in postLists"
                            v-bind:key="index"
                          >
                            <!-- <a href="">{{ post.cDescription }}</a> -->

                            <div
                              class="single-what-news mb-100"
                              @click="newsDetail(post.id)"
                            >
                              <div class="what-img">
                                <img v-bind:src="post.image" height="250px" />
                              </div>

                              <div class="what-cap bg-gradient-cyan">
                                <span class="color4"
                                  ><i class="fa-solid fa-earth-asia pr-1"></i
                                  >{{ post.country }}</span
                                >
                                <span class="color2"
                                  ><i class="fa-solid fa-layer-group pr-1"></i
                                  >{{ post.cDesc }}</span
                                >
                                <h4 class=" ">
                                  <a href="">{{ post.title }}</a>
                                </h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Nav Card -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Whats New End -->

    <!--Start pagination -->
    <div class="pagination-area pb-45 text-center">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <div class="single-wrap d-flex justify-content-center">
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-start">
                  <li class="page-item">
                    <a class="page-link" href=""
                      ><span class="flaticon-arrow roted"></span
                    ></a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="">01</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="">02</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="">03</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href=""
                      ><span class="flaticon-arrow right-arrow"></span
                    ></a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End pagination  -->
  </div>
</template>

<script src="../js/HomePage.js"></script>
