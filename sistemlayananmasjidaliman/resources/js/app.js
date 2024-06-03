import "./bootstrap";
import.meta.glob(["../images/**"]);

function getJadwalSholat(){
    fetch('https://api.banghasan.com/sholat/format/json/jadwal/kota/703/tanggal/2017-02-07')
    .then(response => console.log(response))
}

getJadwalSholat();
