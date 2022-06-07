<?php

/**
 *
 */
class extLerntutorenWidgetCounter extends Widget
{

    private function getCount() {
        include_once ( $this->getData()['path'].DS.'models'.DS.'Tutoren.class.php' );
        $tutoren = extLerntutorenModelTutoren::getAllByStatus('created');
        return count($tutoren);
    }

    public function render() {
        $count = $this->getCount();
        $html = '<a href="index.php?page=ext_lerntutoren&view=custom&admin=true" class="btn"><i class="fa fa-graduation-cap"></i>';
        if ($count) {
            $html .= '<span class="label bg-red">'.$count.'</span>';
        }
        $html .= '</a>';
        return $html;
    }

}