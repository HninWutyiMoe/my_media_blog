import axios from "axios";
import {mapGetters} from "vuex";
export default {
  name: "LoginPage",

  data() {
    return {
      userData: {
        email: "",
        password: "",
      },
      tokenStatus: false,
      userStatus : false,
    };
  },

  computed: {
    ...mapGetters(["storageToken" , "storageUserData"]),
  },

  methods: {
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
    accountLogin() {
      // console.log(this.userData);
      axios
        .post("http://localhost:8000/api/user/login", this.userData)
        .then((response) => {
          if (response.data.token == null) {
            // console.log("There is no user");
            this.userStatus = true;
          } else {
            // console.log("Login Success");
            this.userData.email = "";
            this.userData.password = "";
            this.$store.dispatch("setToken", response.data.token);
            this.$store.dispatch("setUserData", response.data.user);
            this.home();
          }
        });
    },
    // check() {
    //   console.log(this.storageToken);
    //   console.log(this.storageUserData);
    // }
  },
};
