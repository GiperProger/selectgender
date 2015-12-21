/**
 * Copyright (c) 2015, Pryadkin Sergey <GiperProger@gmail.com>
 * All rights reserved.

 * ATTENTION: This commercial software is intended for use with Oxwall Free Community Software http://www.oxwall.org/
 * and is licensed under Oxwall Store Commercial License.
 * Full text of this license can be found at http://www.oxwall.org/store/oscl
 */

/**
 * @author Pryadkin Sergey <GiperProger@gmail.com>
 * @package ow_plugins.selectgender.static.js
 * @since 1.0
 */

var SELECTGENDER_Search = function()
{


    this.init = function(params)
    {
        var form = $("form[name=MainSearchForm]");
        var matchSex = $("select[name=match_sex]", form);
        var $gender = $("input[name=sex]", form).val();


        if( params['isUserRegister'] && params['opositeMatchSexSearch']  )
        {
            if ($gender == 1)
            {
                $("[name = match_sex] [value='1']", form). remove();
            }
            else
            {
                $("[name = match_sex] [value='2']", form). remove();
            }
        }

        else if( params['isUserRegister'] && params['sameMatchSexSearch']  )
        {
            $("[value = 1 ]", matchSex).attr("selected", "selected");

            if ($gender == 2)
            {
                $("[name = match_sex] [value='1']", form). remove();
            }
            else
            {
                $("[name = match_sex] [value='2']", form). remove();
            }
        }

        else  if( !params['isUserRegister'] && params['opositeMatchSexSearch'] )
        {
            $("select[name=sex]", form).change
            (
                function()
                {
                    $sex = $("select[name=sex]").val();
                    $("select[name=match_sex] option").remove();
                    $("select[name=sex] option").each
                    (
                        function(k,item)
                        {
                            if( $(item).val() != $sex )
                            {
                                $("select[name=match_sex]").append($(item).clone());
                            }
                        }
                    );
                }
            )

        }

        else  if( !params['isUserRegister'] && params['sameMatchSexSearch'] )
        {
            $("[value = 1 ]", matchSex).attr("selected", "selected");

            $("select[name=sex]", form).change
            (
                function()
                {
                    $sex = $("select[name=sex]").val();
                    $("select[name=match_sex] option").remove();
                    $("select[name=sex] option").each
                    (
                        function(k,item)
                        {
                            if( $(item).val() == $sex )
                            {
                                $("select[name=match_sex]").append($(item).clone());
                            }
                        }
                    );
                }
            )

        }

    }

} 