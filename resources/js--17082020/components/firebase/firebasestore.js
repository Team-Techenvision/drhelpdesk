import * as  firebase from "firebase/app";
import "firebase/auth";
import "firebase/database";

var firebaseConfig = {
    apiKey: "AIzaSyDTBDZUJO8TSr355kXfHKoodVT__zE64ic",
    authDomain: "chatapps-1e885.firebaseapp.com",
    databaseURL: "https://chatapps-1e885.firebaseio.com",
    projectId: "chatapps-1e885",
    storageBucket: "chatapps-1e885.appspot.com",
    messagingSenderId: "51449737158",
    appId: "1:51449737158:web:9aad10a81d29dae7540cc7",
    measurementId: "G-JVFFN1DCC7"
  };



let firebaseApp =firebase.initializeApp(firebaseConfig);
// let firebaseAuth=firebase.auth();
let firebaseDb = firebaseApp.database();

export default firebaseDb
