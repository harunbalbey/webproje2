
        function filmOner() {
            var tur = document.getElementById('filmTuru').value;
            var yerlilik = document.getElementById('filmYerliligi').value;

            var hedefSayfa;

            if (yerlilik === "yerli") {
                if (tur === "komedi") {
                    hedefSayfa = "yerlikomedi.html";
                } else if (tur === "dram") {
                    hedefSayfa = "yerlidram.html";
                } else if (tur === "aksiyon") {
                    hedefSayfa = "yerliaksiyon.html";
                }
            } else if (yerlilik === "yabanci") {
                if (tur === "komedi") {
                    hedefSayfa = "yabancıkomedi.html";
                } else if (tur === "dram") {
                    hedefSayfa = "yabancıdram.html";
                } else if (tur === "aksiyon") {
                    hedefSayfa = "yabancıaksiyon.html";
                }
            }

            if (hedefSayfa) {
                window.location.href = hedefSayfa;
            }
        }