
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
        berita: berita.trim(),
        lihat: 0,
        komentar: 0,
        like: 0,
        dislike: 0
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
    waktu = tahun + "-" + bulan + "-" + tanggal + " " + h + ":" + m + ":" + s;
    return tahun + "" + bulan + "" + tanggal + "" + h + "" + m + "" + s;
}

function cariLink(callback, link) {
    var carilink;
    firebase.database().ref("berita")
            .orderByChild("url").equalTo(link).once("value")
            .then(function(snapshot) {
                callback(snapshot.numChildren());
            });
}
var i = 0;
editbrt = [];
function bacaBerita(callback) {
    firebase.database().ref("berita")
            .orderByChild("url")
            .on("child_added", function(snapshot) {
                var berita = [];
                var edit = [];
                edit[0] = snapshot.key;
                edit[1] = snapshot.val().judul;
                edit[2] = snapshot.val().berita;
                editbrt[i] = edit;
                berita[0] = snapshot.val().tanggal;
                berita[1] = "<a href=" + snapshot.val().url + ">" + snapshot.val().judul + "</a>";
                berita[2] = snapshot.val().sumber;
                berita[3] = snapshot.val().lihat;
                berita[4] = snapshot.val().komentar;
                berita[5] = snapshot.val().like;
                berita[6] = snapshot.val().dislike;
                berita[7] = "<button type='button' onClick='formEdit(editbrt[" + i + "][0], editbrt[" + i + "][1], editbrt[" + i + "][2])' class='btn btn-block btn-warning btn-xs'>Edit</button>";
                berita[8] = "<button type='button' onClick='deleteBerita(editbrt[" + i + "][0])' class='btn btn-block btn-danger btn-xs'>Delete</button>";
                i++;
                callback(berita);
            });

}

idberita = "";
function formEdit(id, jdl, brt) {
    idberita = id;
    judul.value = jdl;
    berita.value = brt;
    modal.style.display = "block";

}

function deleteBerita(id) {
    firebase.database().ref("berita/" + id).remove(function(error) {
        if (error) {
            alert("Error deleting data:", error);
        } else {
            location.reload();
            alert("Sukses deleting data");
        }
    });
}

function addHistoryBerita(brtmasuk, brtfilter, status, time, log){
    var date = myFunction();
    firebase.database().ref('historyBerita/' + date).set({
        tanggal: waktu,
        beritamasuk: brtmasuk,
        beritafilter: brtfilter,
        waktu: time,
        status: status,
        log: log
    });
}



