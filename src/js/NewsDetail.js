import axios from "axios";
import { mapGetters } from "vuex";
export default {
  name: "NewsDetail", //vue name
  data() {
    return {
      postId: 0,
      posts: {},
      tokenStatus: false,
      viewCount : 0,
    };
  },

  computed: {
    ...mapGetters(["storageToken", "storageUserData"]),
  },

  methods: {
    getPostId(id) {
      let post = {
        postId: id,
      };

      axios
        .post("http://localhost:8000/api/post/detail", post)
        .then((response) => {
          console.log(response.data.post);

          // For image
          if (response.data.post.image != null) {
            response.data.post.image =
              "http://localhost:8000/postImage/" + response.data.post.image;
          } else {
            response.data.post.image = "http://localhost:8000/photo/null.png";
          }
          // For Video
          if (response.data.post.video != null) {
            response.data.post.video =
              "http://localhost:8000/postVideo/" + response.data.post.video;
          } else {
            response.data.post.video = "http://localhost:8000/photo/null.png";
          }

          this.posts = response.data.post;
        });
    },
    back() {
      history.back();

      // this.$router.push({
      //   name: "home", // index.ts ka name
      // });
    },

    home() {
      this.$router.push({
        name: "home",
      });
    },

    login() {
      this.$router.push({
        name: "loginPage",
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
    // console.log(this.storageUserData.id);
    let data = {
      user_id: this.storageUserData.id ,
      post_id: this.$route.query.newsId,
    };
    axios 
    .post("http://localhost:8000/api/post/actionLog" , data)
    .then((response) => {
      this.viewCount = response.data.post.length;
    });
    
    this.checkToken();
    this.postId = this.$route.query.newsId;
    this.getPostId(this.postId);
  },
};
