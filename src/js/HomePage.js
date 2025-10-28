import axios from "axios";
import {mapGetters} from "vuex";
export default {
  name: "HomePage",
  data() {
    return {
      // message : 'This is testing code lab',
      postLists: {},
      categoryLists: {},
      countryLists: {},
      searchKey: "",
      tokenStatus: false,
    };
  },

  computed: {
    ...mapGetters(["storageToken" , "storageUserData"]),
  },
  // postImage/my_media_admin/public/

  methods: {
    getAllPost() {
      axios
      .get("http://localhost:8000/api/allPostList")
      .then((response) => {
        // this.postLists = response.data.post;
        // console.log(this.postLists);
        // console.log(response.data.post.length);

        for (let i = 0; i < response.data.post.length; i++) {
          // For image
          if (response.data.post[i].image != null) {
            response.data.post[i].image =
              "http://localhost:8000/postImage/" + response.data.post[i].image;
          } else {
            response.data.post[i].image =
              "http://localhost:8000/photo/null.png";
          }
          // For Video
          if (response.data.post.video != null) {
            response.data.post.video =
              "http://localhost:8000/postVideo/" + response.data.post.video;
          } else {
            response.data.post.video = "http://localhost:8000/photo/null.png";
          }
        }
        this.postLists = response.data.post;
        console.log(response.data.post);
      });
    },

    categoryList() {
      axios
        .get("http://localhost:8000/api/category")

        .then((response) => {
          console.log(response.data);
          this.categoryLists = response.data.getCategory;
        })

        .catch((err) => {
          console.log(err);
        });
    },

    countryList() {
      axios
        .get("http://localhost:8000/api/country")

        .then((response) => {
          console.log(response.data);
          this.countryLists = response.data.getCountry;
        })

        .catch((err) => {
          console.log(err);
        });
    },

    searchFunction() {
      // alert(this.searchKey);
      let search = {
        searchValue: this.searchKey,
      };

      axios
        .post("http://localhost:8000/api/postTitle/search", search)
        .then((response) => {
          // console.log(response.data.searchTitle);
          for (let i = 0; i < response.data.searchTitle.length; i++) {
            // For image
            if (response.data.searchTitle[i].image != null) {
              response.data.searchTitle[i].image =
                "http://localhost:8000/postImage/" +
                response.data.searchTitle[i].image;
            } else {
              response.data.searchTitle[i].image =
                "http://localhost:8000/photo/null.png";
            }
            // For Video
            if (response.data.searchTitle.video != null) {
              response.data.searchTitle.video =
                "http://localhost:8000/postVideo/" + response.data.searchTitle.video;
            } else {
              response.data.searchTitle.video = "http://localhost:8000/photo/null.png";
            }
          }
          this.postLists = response.data.searchTitle;
        });
    },

    home(){
      this.$router.push({
        name: "home" ,
      });
    },

    login() {
      this.$router.push({
        name: "loginPage" ,
      });
    },

    categoryBar(clickCategoryBar) {
      // alert(clickCategoryBar);
      let search = {
        key: clickCategoryBar,
      };

      axios
        .post("http://localhost:8000/api/category/search", search)
        .then((response) => {
          for (let i = 0; i < response.data.barSearch.length; i++) {
            // For image
            if (response.data.barSearch[i].image != null) {
              response.data.barSearch[i].image =
                "http://localhost:8000/postImage/" +
                response.data.barSearch[i].image;
            } else {
              response.data.barSearch[i].image =
                "http://localhost:8000/photo/null.png";
            }
            // For Video
            if (response.data.barSearch.video != null) {
              response.data.barSearch.video =
                "http://localhost:8000/postVideo/" + response.data.barSearch.video;
            } else {
              response.data.barSearch.video = "http://localhost:8000/photo/null.png";
            }
          }
          this.postLists = response.data.barSearch;
        })
        .catch((e) => console.log(e));
    },

    newsDetail(id) {
      // alert(id);
      this.$router.push({
        name: "newsDetail", // index.ts ka name
        query: {
          newsId: id,
        },
      });
    },

    logout() {
      this.$store.dispatch("setToken", null);
      this.login();
    },
    checkToken() {
      if (
        this.storageToken != null &&
        this.storageToken != undefined &&
        this.storageToken != ""
      ) {
        this.tokenStatus = true;
      } else {
        this.tokenStatus = false;
      }
    },
  },
  mounted() {
    console.log(this.storageToken);
    this.checkToken();
    this.getAllPost();
    this.categoryList();
    this.countryList();
  },
};
