<?php
    include_once "config.php";
class Club
{
    private ?int $id = null;
    private ?string $nom = null;
    private ?string $description = null;
    private ?string $adresse = null;
    private ?string $domaine= null;

    /**
     * @param int|null $id
     * @param string|null $nom
     * @param string|null $description
     * @param string|null $adresse
     * @param string|null $domaine
     */
    public function __construct(?int $id, ?string $nom, ?string $description, ?string $adresse, ?string $domaine)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->adresse = $adresse;
        $this->domaine = $domaine;
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        echo "this is a destructor";
    }

    public function afficherClub(){
        echo "<b> ID : </b>" . $this->id . "<br/>";
        echo "<b> Nom : </b>" . $this->nom . "<br/>";
        echo "<b> Domaine : </b>" . $this->domaine . "<br/>";
        echo "<b> Description : </b>" . $this->description . "<br/>";
        echo "<b> Adresse : </b>" . $this->adresse . "<br/>";
    }

    public function afficherClubs(){
        $db = config::getConnexion();
        $selectQuery = "SELECT * FROM club";
        try{
            $listeClub = $db->query($selectQuery);
            return $listeClub;
        }catch(Exception $exception){
            die( "Exception throw ". $exception->getMessage());
        }
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string|null $nom
     */
    public function setNom(?string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    /**
     * @param string|null $adresse
     */
    public function setAdresse(?string $adresse): void
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string|null
     */
    public function getDomaine(): ?string
    {
        return $this->domaine;
    }

    /**
     * @param string|null $domaine
     */
    public function setDomaine(?string $domaine): void
    {
        $this->domaine = $domaine;
    }



}