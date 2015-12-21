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
var SELECTGENDER_Join = function()
{


    this.init = function(params)
    {
        var joinForm = $("form[name=joinForm]");
        var matchSexMale = $("li input[value=1][name=\'match_sex[]\'] ");
        var matchSexFemale = $("li input[value=2][name=\'match_sex[]\'] ");



            matchSexMale.hide();
            $("[for=" + matchSexMale.attr("id") + "]").hide();

            matchSexFemale.hide();
            $("[for=" + matchSexFemale.attr("id") + "]").hide();

            $("select[name=sex]", joinForm).change
            (
                function()
                {
                    $genderVal = $("select[name=sex]",joinForm).val();

                    if(params['opositeMatchSexJoin'])
                    {
                        if ($genderVal == 1)
                        {

                            matchSexFemale.attr("checked", true);
                            matchSexMale.attr("checked", false);

                            matchSexMale.hide();
                            $("[for=" + matchSexMale.attr("id") + "]").hide();

                            matchSexFemale.show();
                            $("[for=" + matchSexFemale.attr("id") + "]").show();

                        }
                        else
                        {
                            matchSexMale.attr("checked", true);
                            matchSexFemale.attr("checked", false);

                            matchSexFemale.hide();
                            $("[for=" + matchSexFemale.attr("id") + "]").hide()

                            matchSexMale.show();
                            $("[for=" + matchSexMale.attr("id") + "]").show();
                        }
                    }

                    if(params['sameMatchSexJoin'])
                    {
                        if ($genderVal == 2)
                        {
                            $gender = $("input[value=2][name=\'match_sex[]\'] ");
                            $gender.attr("checked", true);
                            matchSexMale.attr("checked", false);

                            matchSexMale.hide();
                            $("[for=" + matchSexMale.attr("id") + "]").hide();

                            matchSexFemale.show();
                            $("[for=" + matchSexFemale.attr("id") + "]").show();

                        }
                        else
                        {
                            matchSexMale.attr("checked", true);
                            matchSexFemale.attr("checked", false);

                            matchSexFemale.hide();
                            $("[for=" + matchSexFemale.attr("id") + "]").hide();

                            matchSexMale.show();
                            $("[for=" + matchSexMale.attr("id") + "]").show();

                        }
                    }

                }
            )


    }

}