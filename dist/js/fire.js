
var config = {
    apiKey: "AIzaSyAPGTn-2wJevQvOCH4E8cNQzJwdQmz7Zxk",
    authDomain: "rssmedia-3300c.firebaseapp.com",
    databaseURL: "https://rssmedia-3300c.firebaseio.com",
    storageBucket: "rssmedia-3300c.appspot.com",
    messagingSenderId: "675061780565"
};

firebase.initializeApp(config);
var waktu;
function tambahBerita(sumber, link, judul, gambar, berita) {
    var date = myFunction();
    firebase.database().ref('berita/' + date).set({
        tanggal: waktu,
        sumber: sumber,
        url: link,
        judul: judul,
        gambar: gambar,
        berita: berita.trim()
    });
}

function addZero(x, n) {
    while (x.toString().length < n) {
        x = "0" + x;
    }
    return x;
}

function myFunction() {
    var d = new Date();
    var tanggal = addZero(d.getDate(), 2);
    var bulan = addZero(d.getMonth(), 2);
    var tahun = addZero(d.getFullYear(), 4);
    var h = addZero(d.getHours(), 2);
    var m = addZero(d.getMinutes(), 2);
    var s = addZero(d.getSeconds(), 2);
    waktu = tahun+"-"+bulan+"-"+tanggal+" "+h+":"+m+":"+s;
    return tahun+""+bulan+""+tanggal+""+h+""+m+""+s;
}