<?php

namespace Gregwar\DSD\Fields;

/**
 * Checkboxs
 *
 * @author GrÃ©goire Passault <g.passault@gmail.com>
 */
class MulticheckboxField extends Field
{
    private $datas;
    private $checked = array();
    private $source;

    public function check()
    {
        return;
    }

    public function push($var, $val)
    {
        switch ($var) {
        case 'source':
            $this->source = $val;
            break;
        default:
            parent::push($var,$val);
            break;
        }
    }

    public function getSource()
    {
        return $this->source;
    }

    public function source($datas)
    {
        $this->datas = $datas;
    }

    public function setValue($val)
    {
        $this->checked=array();
        if (!is_array($val)) {
            $tmp=explode(",",$val);
            $val = array();
            foreach ($tmp as $k=>$v) {
                $val[$v] = "1";
            }
        }
        foreach ($val as $k => $v) {
            if (isset($this->datas[$k]) && $v=="1") {
                $this->checked[$k]="1";
            }
        }
    }

    public function getValue()
    {
        $tmp = array();
        foreach ($this->checked as $k=>$v) {
            $tmp[] = $k;
        }
        return $tmp;
    }

    public function getHTML()
    {
        $html = '';

        if (is_array($this->datas)) {
            foreach ($this->datas as $value => $label) {
                if (isset($this->checked[$value])) {
                    $checked = ' checked="checked"';
                } else {
                    $checked = '';
                }

                $html.= "<div class=\"".$this->getAttribute('class')."\">\n";
                $html.= "<input type=\"checkbox\" name=\"".$this->name."[$value]\"$checked id=\"".$this->name."_$value\" value=\"1\" />\n";
                $html.= "<label for=\"".$this->name."_$value\">".$label."</label>\n";
                $html.= "</div>\n";
            }
        }

        return $html;
    }
}