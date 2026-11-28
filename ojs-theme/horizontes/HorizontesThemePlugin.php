<?php

namespace APP\plugins\themes\horizontes;

use PKP\plugins\ThemePlugin;

class HorizontesThemePlugin extends ThemePlugin
{
    /**
     * Se ejecuta solo cuando el tema está activo.
     */
    public function init()
    {
        // Usamos el tema por defecto como base y solo cambiamos lo necesario.
        $this->setParent('defaultthemeplugin');

        // Estilos propios (colores, menú, animaciones).
        $this->addStyle('horizontes', 'styles/index.less');

        // Animaciones con JavaScript (aparición al hacer scroll).
        $this->addScript('horizontes-main', 'js/main.js');
    }

    public function getDisplayName()
    {
        return 'SanColFree (tema de la revista)';
    }

    public function getDescription()
    {
        return 'Tema hijo del tema por defecto con la identidad visual de la plataforma SanColFree.';
    }
}
