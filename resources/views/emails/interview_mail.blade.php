<!-- THIS EMAIL WAS BUILT AND TESTED WITH LITMUS http://litmus.com -->
<!-- IT WAS RELEASED UNDER THE MIT LICENSE https://opensource.org/licenses/MIT -->
<!-- QUESTIONS? TWEET US @LITMUSAPP -->
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting"> <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title>Stationary - [Plain HTML]</title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <!-- Web Font / @font-face : BEGIN -->
    <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->

    <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->
    <!--[if mso]>
        <style>
            * {
                font-family: Arial, sans-serif !important;
            }
        </style>
    <![endif]-->

    <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
    <!--[if !mso]><!-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,500" rel="stylesheet">
    <!--<![endif]-->

    <!-- Web Font / @font-face : END -->

    <!-- CSS Reset -->
    <style>
        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        table table table {
            table-layout: auto;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode: bicubic;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        *[x-apple-data-detectors],
        /* iOS */
        .x-gmail-data-detectors,
        /* Gmail */
        .x-gmail-data-detectors *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying an download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }

        /* If the above doesn't work, add a .g-img class to any image in question. */
        img.g-img+div {
            display: none !important;
        }

        /* What it does: Prevents underlining the button text in Windows 10 */
        .button-link {
            text-decoration: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size you'd like to fix */
        /* Thanks to Eric Lepetit @ericlepetitsf) for help troubleshooting */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {

            /* iPhone 6 and 6+ */
            .email-container {
                min-width: 375px !important;
            }
        }

    </style>

    <!-- Progressive Enhancements -->
    <style>
        /* What it does: Hover styles for buttons */
        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }

        .button-td:hover,
        .button-a:hover {
            background: #555555 !important;
            border-color: #555555 !important;
        }

        /* Media Queries */
        @media screen and (max-width: 480px) {

            /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */
            .fluid {
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }

            /* What it does: Forces table cells into full-width rows. */
            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }

            /* And center justify these ones. */
            .stack-column-center {
                text-align: center !important;
            }

            /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }

            table.center-on-narrow {
                display: inline-block !important;
            }

            /* What it does: Adjust typography on small screens to improve readability */
            .email-container p {
                font-size: 17px !important;
                line-height: 22px !important;
            }

        }

        #btn {
            color: white;
            background-color: #2745D9;
            border: none;
            padding: 10px;
            display: inline;
            border-radius: 10px;
        }

        #btn:hover {
            background-color: #2586C6;
            transition: 0.5s;
        }

        #btn_two {
            color: white;
            background-color: #E81E1E;
            float: left;
            /* margin-top: 30px;  */
            padding: 10px;
            display: inline;
            border-radius: 10px;
            display:inline
        }

        #btn_two:hover {
            background-color: #B22929;
            transition: 0.5s;
        }
        #btn_three {
            color: white;
            background-color: #1D830F;
            float: left;
            margin-top: 10px; 
            padding: 10px;
            display: inline;
            border-radius: 10px;
            display:inline
        }

        #btn_three:hover {
            background-color: #40BD2F;
            transition: 0.5s;
        }

    </style>

    <!-- What it does: Makes background images in 72ppi Outlook render at correct size. -->
    <!--[if gte mso 9]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->

</head>

<body width="100%" bgcolor="#F1F1F1" style="margin: 0; mso-line-height-rule: exactly;">
    <center style="width: 100%; background: #F1F1F1; text-align: left;">

        <!-- Visually Hidden Preheader Text : BEGIN -->
        <div
            style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">
            Interview Confirmation
        </div>
        <!-- Visually Hidden Preheader Text : END -->

        <!--
            Set the email width. Defined in two places:
            1. max-width for all clients except Desktop Windows Outlook, allowing the email to squish on narrow but never go wider than 680px.
            2. MSO tags for Desktop Windows Outlook enforce a 680px width.
            Note: The Fluid and Responsive templates have a different width (600px). The hybrid grid is more "fragile", and I've found that 680px is a good width. Change with caution.
        -->
        <div style="max-width: 680px; margin: auto;" class="email-container">
            <!--[if mso]>
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="680" align="center">
            <tr>
            <td>
            <![endif]-->

            <!-- Email Body : BEGIN -->
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%"
                style="max-width: 680px;" class="email-container">


                <!-- HEADER : BEGIN -->
                <tr>
                    <td>
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td style="padding-left:30px; text-align: left;">
                                    {{-- <img src="{{url('public/companylogo/807911625.png')}}" width="200" height="13"
                                    alt="alt_text" border="0"
                                    style="height: auto; font-family: sans-serif; font-size: 15px; line-height: 20px;
                                    color: #555555;"> --}}


                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- HEADER : END -->



                <!-- HERO : BEGIN -->
                <tr>
                    <td bgcolor="#ffffff" style="border:1px solid #dddddd;">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td style="padding-top: 5px ">
                                    <h1
                                        style=" font-family: 'Montserrat', sans-serif; font-size: 20px; line-height: 26px; color: #333333; font-weight: bold; text-transform: uppercase;display:inline;float:left;margin-left:45px;margin-top:20px;">
                                        Interview Confirmation</h1>
                                    <h1
                                        style="color:#2641C6;font-weight:bold;font-size:30px;font-family:Gill Sans, sans-serif;float:right;display:inline;margin-right:60px;">
                                        <i>IT-SCIENT</i></h1>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="padding: 0px 40px 20px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; text-align: left;">
                                    <div style="width:40%;float:left;background-color:#F0F0F0;padding:10px;">
                                        <p><b>Job Details:-</b></p>
                                        {{-- <p>Job ID</p> --}}
                                        <p>Job Title</p>
                                        <p>Job Company</p>
                                        <p>Location</p>
                                    </div>
                                    <div style="width:50%;float:left;background-color:#F0F0F0;padding:10px;">
                                        <p>&nbsp;</p>
                                        {{-- <p>{{$data['jobcode_id']}}</p> --}}
                                        <p>{{$data['jobcode_code']}}</p>
                                        <p>{{$data['job_data']['client_name']}}</p>
                                        <p>{{$data['job_data']['country']}} , {{$data['job_data']['city']}} ,
                                            {{$data['job_data']['state']}}</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="padding: 0px 40px 20px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; text-align: left; font-weight:normal;">
                                    <div style="width:40%;float:left;background-color:#F0F0F0;padding:10px;">
                                        <p><b>Candidate Details:-</b></p>
                                        <p>Name</p>
                                        <p>Phone (M)</p>
                                        <p>Phone (H)</p>
                                        @if(($data['candidatename_detail']['skype_id']
                                        !=="")&&($data['candidatename_detail']['skype_id'] !==null))
                                        <p>Skype</p>
                                        @endif
                                        <p>Email</p>
                                    </div>
                                    <div style="width:50%;float:left;background-color:#F0F0F0;padding:10px;">
                                        <p>&nbsp;</p>
                                        <p>{{$data['candidatename_name']}}</p>
                                        <p>{{$data['candidatename_detail']['mobile']}}</p>
                                        <p>{{$data['candidatename_detail']['home_phone']}}</p>
                                        @if(($data['candidatename_detail']['skype_id']
                                        !=="")&&($data['candidatename_detail']['skype_id'] !==null))
                                        <p>{{$data['candidatename_detail']['skype_id']}}</p>
                                        @endif
                                        <p>{{$data['candidatename_detail']['email']}}</p>

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="padding: 0px 40px 20px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; text-align: left; font-weight:normal;">
                                    <div style="width:40%;float:left;background-color:#F0F0F0;padding:10px;">
                                        <p><b>Interview details:-</b></p>
                                        @if(($data['venue'] !== "")&&($data['venue'] !== null))
                                        <p>Venue</p>
                                        @endif
                                        <p>Interview Type</p>
                                    </div>
                                    <div style="width:50%;float:left;background-color:#F0F0F0;padding:10px;">
                                        <p>&nbsp;</p>
                                        @if($data['venue'] !== "")
                                        <p>{{$data['venue']}}</p>
                                        @endif
                                        <p>{{$data['type_int']}}</p>


                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="padding: 0px 40px 20px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; text-align: left; font-weight:normal;">
                                    <div style="width:40%;float:left;background-color:#F0F0F0;padding:10px;">
                                        <p><b>Time & Date ( Time in 24hr ):-</b></p>
                                        <p style="font-weight:bold;">Start Date</p>
                                        <p style="font-weight:bold;">{{$data['interviewdate']}}</p>
                                        <p style="font-weight:bold;">Start Time</p>
                                        <p style="font-weight:bold;">{{$data['start_time']}}</p>

                                    </div>
                                    <div style="width:50%;float:left;background-color:#F0F0F0;padding:10px;">
                                        <p>&nbsp;</p>
                                        <p style="font-weight:bold;">End Date</p>
                                        @if(($data['end_date'] !=="")&&($data['end_date'] !==null))
                                        <p style="font-weight:bold;">{{$data['end_date']}}</p>
                                        @else
                                        <p style="font-weight:bold;">{{$data['interviewdate']}}</p>
                                        @endif
                                        <p style="font-weight:bold;">End Time</p>
                                        <p style="font-weight:bold;">{{$data['end_time']}}</p>



                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td
                                    style="padding: 0px 40px 20px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; text-align: left; font-weight:normal;">
                                    <a id="btn"
                                        href="{{url('http://baba.software/ats/interview_confirm/'.$data['uni_no'])}}"
                                        type="button" style="text-decoration:none;">Accept</a>
                                    <p style="display:inline;margin-left:20px;">Click to go to conformatation page</p>
                                    <br><br>
                                    <a id="btn_two"
                                        href="{{url('http://baba.software/ats/reject_request/'.$data['uni_no'])}}"
                                        type="button" style="text-decoration:none;display:inline">Reject</a>
                                    {{-- <p style="display:inline;margin-left:20px;margin-top:10px">Click to go to the page</p> --}}
                                    <br><br>
                                    <a id="btn_three"
                                        href="{{url('http://baba.software/ats/reject_reschedule/'.$data['uni_no'])}}"
                                        type="button" style="text-decoration:none;display:inline">Request another time</a>
                                    


                                    {{-- <a id="btn" href="{{url('http://baba.software/ats/interview_confirm/'.$data['uni_no'])}}"
                                    type="button" style="text-decoration:none;">Confirm</a>
                                    <p style="display:inline;margin-left:20px;">Click to go to conformatation page</p>
                                    --}}
                                    {{-- <a id="btn" href="{{URL::to('http://localhost/ats_baba/interview_confirm/'.$data['uni_no'])}}"
                                    type="button" style="text-decoration:none;">Confirm</a>
                                    <p style="display:inline;margin-left:20px;">Click to go to conformatation page</p>
                                    --}}
                                </td>
                            </tr>
                            <td
                                style="padding: 0px 40px 40px 40px; font-family: sans-serif; font-size: 12px; line-height: 18px; color: #666666; text-align: left; font-weight:normal;">

                                <p style="margin: 0;">Copyright 2019-2020 <b>ATS BABA</b>, All Rights
                                    Reserved.</p>

                            </td>

                            <tr>
                                {{-- <td align="left" style="padding: 0px 40px 40px 40px;">

                                    <table width="180" align="left">
                                        <tr>
                                            <td width="70">
                                                <img src="http://glennsmith.me/email/litmus/images/profile-picture.png"
                                                    width="62" height="62"
                                                    style="margin:0; padding:0; border:none; display:block;" border="0"
                                                    alt="">
                                            </td>
                                            <td width="110">

                                                <table width="" cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                        <td align="left"
                                                            style="font-family: sans-serif; font-size:14px; line-height:20px; color:#222222; font-weight:bold;"
                                                            class="body-text">
                                                            <p style="font-family: 'Montserrat', sans-serif; font-size:14px; line-height:20px; color:#222222; font-weight:bold; padding:0; margin:0;"
                                                                class="body-text">Anna Bella</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left"
                                                            style="font-family: sans-serif; font-size:14px; line-height:20px; color:#666666;"
                                                            class="body-text">
                                                            <p style="font-family: sans-serif; font-size:14px; line-height:20px; color:#666666; padding:0; margin:0;"
                                                                class="body-text">CEO | Vision</p>
                                                        </td>
                                                    </tr>
                                                </table>

                                            </td>
                                        </tr>
                                    </table>

                                </td> --}}
                            </tr>

                        </table>
                    </td>
                </tr>
                <!-- HERO : END -->

                <!-- FOOTER : BEGIN -->
                <tr>
                    <td>
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                {{-- <td
                                    style="padding: 40px 40px 10px 40px; font-family: sans-serif; font-size: 12px; line-height: 18px; color: #666666; text-align: left; font-weight:normal;">
                                    <p style="margin: 0;">IT-SCIENT</p>
                                </td> --}}
                            </tr>
                            {{--  <tr>
                                <td
                                    style="padding: 0px 40px 10px 40px; font-family: sans-serif; font-size: 12px; line-height: 18px; color: #666666; text-align: left; font-weight:normal;">
                                    <p style="margin: 0;">This email was sent to you from %%Company Email Address%%</p>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="padding: 0px 40px 10px 40px; font-family: sans-serif; font-size: 12px; line-height: 18px; color: #666666; text-align: left; font-weight:normal;">
                                    <p style="margin: 0;">%%Preferences%% | %%Browser%% | %%Forward%% | %%Unsubscribe%%
                                    </p>
                                </td>
                            </tr>
                            <tr> --}}


                </tr>

            </table>
            </td>
            </tr>
            <!-- FOOTER : END -->

            </table>
            <!-- Email Body : END -->

            <!--[if mso]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </div>

    </center>
</body>

</html>
