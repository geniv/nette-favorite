<?php declare(strict_types=1);

use GeneralForm\ITemplatePath;
use Nette\Application\UI\Control;
use Nette\Localization\ITranslator;


/**
 * Class Favorite
 *
 * @author  geniv
 */
class Favorite extends Control implements ITemplatePath
{
    /** @var ITranslator */
    private $translator;
    /** @var string */
    private $templatePath;
    /** @var array */
    private $values;
    /** @var callable */
    public $onSetFavorite;


    /**
     * Favorite constructor.
     *
     * @param ITranslator|null $translator
     */
    public function __construct(ITranslator $translator = null)
    {
        parent::__construct();

        $this->translator = $translator;

        $this->templatePath = __DIR__ . '/Favorite.latte'; // set path
    }


    /**
     * Set template path.
     *
     * @param string $path
     */
    public function setTemplatePath(string $path)
    {
        $this->templatePath = $path;
    }


    /**
     * Handle set favorite.
     *
     * @param int $id
     */
    public function handleSetFavorite(int $id)
    {
        $this->onSetFavorite($id);
    }


    /**
     * Set source.
     *
     * @param array|null $values
     */
    public function setSource(array $values = null)
    {
        $this->values = (array) $values;
    }


    /**
     * Is favorite.
     *
     * @param int $id
     * @return bool
     */
    public function isFavorite(int $id): bool
    {
        return isset($this->values[$id]);
    }


    /**
     * Render.
     *
     * @param int $id
     */
    public function render(int $id)
    {
        $template = $this->getTemplate();

        $template->id = $id;
        $template->isFavorite = function (int $id) {
            return $this->isFavorite($id);
        };

        $template->setTranslator($this->translator);
        $template->setFile($this->templatePath);
        $template->render();
    }
}
