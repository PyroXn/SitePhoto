<?php

    $tabImage = array();
    $tabMembre = array();
    $tabImage = getFooterImage();
    $tabMembre = getFooterMembre();
?>
</div>
        </div>
        <div id="footer">
            <div id="raccourci">
                <div id="colonne1">
                    <h2>
                        Derniers gagnants
                    </h2>
                    <ol>
                        <li><a title="PyrO" href="#"><img src="./templates/images/1312873921_trophy.png" alt="trophÃ© en or"></img>PyrO</a></li>
                        <li><a title="FloW" href="#"><img src="./templates/images/1312873916_trophy_silver.png" alt="trophÃ© en argent"></img>FloW</a></li>
                        <li><a title="Bad" href="#"><img src="./templates/images/1312873919_trophy_bronze.png" alt="trophÃ© en bronze"></img>Bad</a></li>
                    </ol>
                </div>
                <div id="colonne2">
                    <h2>
                        Dernières photos
                    </h2>
                    <ol>
<?php
    for($i = 0; $i <= 2; $i++) {
        echo '<li><a title="'.$tabImage[$i]->getTitre().'" href="'.$tabImage[$i]->getUrl().'" class="zoombox"><img src="thumb.php?src='.$tabImage[$i]->getUrl().'&x=50&y=31&f=0" alt="'.$tabImage[$i]->getTitre().'"></img>'.$tabImage[$i]->getTitre().'</a></li>';
    }
?>
                    </ol>
                </div>
                <div id="colonne3">
                    <h2>
                        Derniers commentaires
                    </h2>
                    <ol>
                        <li><img src="./templates/images/iconeBulleDialog.png" alt=""></img><h4>Cucu Lapraline</h4>Trop mignon ton chat !</li>
                        <li><img src="./templates/images/iconeBulleDialog.png" alt=""></img><h4>Herbert Lepivert</h4>J'aime les chenilles</li>
                        <li><img src="./templates/images/iconeBulleDialog.png" alt=""></img><h4>Sarah Fraichis</h4>Trop beau ton effet flou</li>    
                    </ol>
                </div>
                <div id="colonne4">
                    <h2>
                        Derniers membres
                    </h2>
                    <ol>
<?php
    for($i = 0; $i <= 2; $i++) {
        echo '<li><a title="'.$tabMembre[$i]->getPseudo().'" href="index.php?p=profil&id='.$tabMembre[$i]->getId().'"><img src="thumb.php?src='.$tabMembre[$i]->getAvatar().'&x=30&y=34&f=0" alt="'.$tabMembre[$i]->getPseudo().'"></img>'.$tabMembre[$i]->getPseudo().'</a></li>';
    }   
?>
                    </ol>
                </div>
                <div id="copyright">
                    Copyright - Tous droits réservés.
                </div>
            </div>
        </div>
    </body>
</html>