/**
 * Created by HIBA on 14/04/2020.
 */
var fassakhLesMembresDuGroup = (function () {
    var fassakhLesMembresDuGroup = {};

    var hedhomMaYetfasskhouch = ['1234','11223344'];
    var lesUtilisateursEliBechYetfasskhou = [];
    var scriptYe5dem = false;
    var enCours = false;

    fassakhLesMembresDuGroup.start = function() {
        scriptYe5dem = true;
        fassakhElKol();
    };
    fassakhLesMembresDuGroup.stop = function() {
        scriptYe5dem = false;
    };

    function fassakhElKol() {
        if (scriptYe5dem) {
            listeDesMembresEliBechYetfasskhou();
            rigelElLista();
        }
    }

    function listeDesMembresEliBechYetfasskhou() {
        var actionsDeLadmin = document.getElementsByClassName('adminActions');
        console.log(hedhomMaYetfasskhouch);
        for(var i=0; i<actionsDeLadmin.length; i++) {
            var iconElParametres = actionsDeLadmin[i];
            var lesLiensMta3Ladmin = iconElParametres.getElementsByTagName('a');
            var idDuMembre = iconElParametres.parentNode.parentNode.id.replace('member_','');
            var essmElMembre = khoudhTexteMelElement(iconElParametres.parentNode.parentNode.getElementsByClassName('fcb')[0]);

            if (hedhomMaYetfasskhouch.indexOf(idDuMembre) != -1) {
                console.log("Hedha mahouch bech yetfassakh "+essmElMembre+' ('+idDuMembre+')');
                continue;
            } else {
                lesUtilisateursEliBechYetfasskhou.push({'memberId': idDuMembre, 'gearWheelIconDiv': iconElParametres});
            }
        }
    }

    function rigelElLista() {
        if (!scriptYe5dem) {
            return;
        }
        if (lesUtilisateursEliBechYetfasskhou.length > 0) {
            fassakhNext();

            setTimeout(function(){
                rigelElLista();
            },1000);
        } else {
            zidHet();
        }
    }

    function fassakhNext() {
        if (!scriptYe5dem) {
            return;
        }
        if (lesUtilisateursEliBechYetfasskhou.length > 0) {
            var ElementProchain = lesUtilisateursEliBechYetfasskhou.pop();
            fassakhMembre(ElementProchain.memberId, ElementProchain.iconElParametres);
        }
    }

    function fassakhMembre(idDuMembre, iconElParametres) {
        if (enCours) {
            return;
        }
        var liensElParametre = iconElParametres.getElementsByTagName('a')[0];
        liensElParametre.click();
        enCours = true;
        setTimeout(function(){
            var referenceElPopup = liensElParametre.id;
            var divElPopup = nekhouElementSelonLattribut('data-ownerid',referenceElPopup);
            var lesLiensDuPopup = divElPopup.getElementsByTagName('a');
            for(var j=0; j<lesLiensDuPopup.length; j++) {
                if (lesLiensDuPopup[j].getAttribute('href').indexOf('remove.php') !== -1) {

                    lesLiensDuPopup[j].click();
                    setTimeout(function(){
                        var bouttonElConfirmation = document.getElementsByClassName('layerConfirm uiOverlayButton selected')[0];
                        var formElErreur = nekhouElementSelonLattribut('data-reactid','.4.0');
                        if (bouttonElConfirmation != null) {
                            if (peutCliquer(bouttonElConfirmation)) {
                                bouttonElConfirmation.click();
                            } else {
                                console.log('impossbile: '+idDuMembre);
                                5/0;
                                console.log(iconElParametres);
                            }
                        }
                        if (formElErreur != null) {
                            console.log("erreur wa9t el tafssikh "+idDuMembre);
                            formElErreur.getElementsByClassName('selected  layerCancel autofocus')[0].click();
                        }
                        enCours = false;
                    },700);
                    continue;
                }
            }
        },500);
    }

    function peutCliquer(el) {
        return (typeof el != 'undefined') && (typeof el.click != 'undefined');
    }

    function zidHet() {
        enCours = true;
        encore = document.getElementsByClassName("pam uiBoxLightblue  uiMorePagerPrimary");
        if (typeof encore != 'undefined' && peutCliquer(encore[0])) {
            encore[0].click();
            setTimeout(function(){
                fassakhElKol();
                enCours = false;
            }, 2000);
        } else {
            fassakhLesMembresDuGroup.stop();
        }
    }

    function khoudhTexteMelElement(ElElement) {
        return ElElement.textContent;
    }

    function nekhouElementSelonLattribut(atribut, valeur, route) {
        route = route || document.body;
        if(route.hasAttribute(atribut) && route.getAttribute(atribut) == valeur) {
            return route;
        }
        var fils = route.children,
            element;
        for(var i = fils.length; i--; ) {
            element = nekhouElementSelonLattribut(atribut, valeur, fils[i]);
            if(element) {
                return element;
            }
        }
        return null;
    }
    return fassakhLesMembresDuGroup;
})();
fassakhLesMembresDuGroup.start();