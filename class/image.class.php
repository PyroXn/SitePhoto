<?php

class Image {

    private $id;
    private $url;
    private $titre;
    private $description;
    private $view;
    private $score;
    private $idMembre;
    private $idAlbum;
    private $idConcour;

    /*   CONSTRUCTOR    */

    function __construct($url) {
        $this->url = $url;
    }

    /*    GETTER    */
    
    function getId() {
        return $this->id;
    }
    
    function getUrl() {
        return $this->url;
    }

    function getTitre() {
        return utf8_encode($this->titre);
    }

    function getDescription() {
        return utf8_encode($this->description);
    }

    function getIdMembre() {
        return $this->idMembre;
    }

    function getIdAlbum() {
        return $this->idAlbum;
    }

    function getIdConcour() {
        return $this->idConcour;
    }

    function getHeight() {
        $height = getimagesize($this->url);
        return $height[1];
    }

    function getWidth() {
        $width = getimagesize($this->url);
        return $width[0];
    }

    function getType() {
        $type = getimagesize($this->url);
        return $type[2];
    }
    
    function getName() {
        return basename($this->Url);
    }
    
    function getView() {
        return $this->view;
    }
    
    function getScore() {
        return $this->score;
    }
    /**
     *
     * @return int Retourne 0 si photo paysage
     */
    function getRatio() {
        if($this->getWidth() > $this->getHeight()) {
            return 0;
        }
        else {
            return 1;
        }
    }

    /*    SETTER    */

    function setTitre($titre) {
        $this->titre = strip_tags(mysql_real_escape_string ($titre));
    }
    
    function setId($id) {
        $this->id = $id;
    }
    
    function setUrl($url) {
        $this->url = $url;
    }
    function setDescription($description) {
        $this->description = strip_tags(mysql_real_escape_string ($description));
    }

    function setIdMembre($idMembre) {
        $this->idMembre = $idMembre;
    }

    function setIdAlbum($idAlbum) {
        $this->idAlbum = $idAlbum;
    }

    function setIdConcour($idConcour) {
        $this->idConcour = $idConcour;
    }
    
    function setView($view) {
        $this->view = $view;
    }

    function setScore($score) {
        $this->score = $score;
    }
   
    /*    METHODES    */

    /**
     * Methode utilisé uniquement lors de l'upload
     */
    function get_extension($nom) {
        $nom = explode(".", $nom);
        $nb = count($nom);
        return strtolower($nom[$nb - 1]);
    }
    
    function upload($file) {
        // Extensions images autorisés (pour le moment, que du jpeg)
        $extensions_ok = array('jpg', 'jpeg', 'gif', 'png');
        $typeimages_ok = array(4);
        $taille_ko = 6144; // Taille en kilo octect (ko)
        $taille_max = $taille_ko * 1024; // En octects
        $dest_dossier = 'pics/'; // Creez ce dossier et chmoodez le !
        if (isset($file)) { // On vérifie que le fichier existe
 
            // On vérifie qu'il s'agit bien d'une image
            if (!$getimagesize = getimagesize($file['tmp_name'])) {
                $erreurs[] = "Le fichier n'est pas une image valide.";
            }

            // On vérifie que le format de l'image est accepté
            if (!in_array($this->get_extension($file['name']), $extensions_ok)) {
                foreach ($extensions_ok as $text) {
                    $extensions_string .= $text . ', ';
                }
                $erreurs[] = 'Veuillez selectionner un fichier de type ' . substr($extensions_string, 0, -2) . '.';
            }

            // On vérifie le poid de l'image
            if (file_exists($file['tmp_name']) && filesize($file['tmp_name']) > $taille_max) {
                $erreurs[] = "Votre fichier doit faire moins de $taille_ko Ko !";
            }

            // Si aucune erreur, on upload
            if (!isset($erreurs)) {
                $dest_fichier = basename($file['name']);
                $dest_fichier = strtr($dest_fichier, 'Ã€ÃÃ‚ÃƒÃ„Ã…Ã‡ÃˆÃ‰ÃŠÃ‹ÃŒÃÃŽÃÃ’Ã“Ã”Ã•Ã–Ã™ÃšÃ›ÃœÃÃ Ã¡Ã¢Ã£Ã¤Ã¥Ã§Ã¨Ã©ÃªÃ«Ã¬Ã­Ã®Ã¯Ã°Ã²Ã³Ã´ÃµÃ¶Ã¹ÃºÃ»Ã¼Ã½Ã¿', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                // un regex pour remplacer tous ce qui n'est ni chiffre ni lettre par "_"
                $dest_fichier = preg_replace('/([^.a-z0-9]+)/i', '_', $dest_fichier);
                $dest_fichier = strtolower($dest_fichier);

                // Si le nom est déjà utilisé
                while (file_exists($dest_dossier . $dest_fichier)) {
                    $dest_fichier = rand() . $dest_fichier;
                }

                // On upload l'image
                if (move_uploaded_file($file['tmp_name'], $dest_dossier . $dest_fichier)) {
                    return $dest_dossier . $dest_fichier;
                }
            } else {
                return $erreurs;
            }
        }
    }
    
    

}

?>
