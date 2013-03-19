<?php
/**
 * CalibreFx
 *
 * WordPress Themes Framework by CalibreFx Team
 *
 * @package		CalibreFx
 * @author		CalibreFx Team
 * @copyright           Copyright (c) 2012, Suntech Inti Perkasa.
 * @license		Commercial
 * @link		http://www.calibrefx.com
 * @since		Version 1.0
 * @filesource 
 *
 * WARNING: This file is part of the core CalibreFx framework. DO NOT edit
 * this file under any circumstances. 
 *
 * This File will handle theme-settings and provide default settings
 *
 * @package CalibreFx
 */

/**
 * Calibrefx Other Settings Class
 *
 * @package		Calibrefx
 * @subpackage          Library
 * @author		CalibreFx Team
 * @since		Version 1.0
 * @link		http://www.calibrefx.com
 */
class CFX_Other_Settings extends CFX_Admin {

    /**
     * Constructor - Initializes
     */
    function __construct() {
        $this->page_id = 'calibrefx-other';
        $this->default_settings = apply_filters('calibrefx_other_settings_defaults', array(
                
            )
        );

        //we need to initialize the model
        $CFX = & calibrefx_get_instance();
        $CFX->load->model('other_settings_m');
        $this->_model = & $CFX->other_settings_m;

        $this->initialize();
    }

    /**
     * Register Our Security Filters
     *
     * $return void
     */
    public function security_filters() {
        $CFX = & calibrefx_get_instance();

        $CFX->security->add_sanitize_filter(
                'one_zero', $this->settings_field, array(
            
            )
        );

        $CFX->security->add_sanitize_filter(
                'safe_text', $this->settings_field, array(
           )
        );

        $CFX->security->add_sanitize_filter(
                'integer', $this->settings_field, array(
            )
        );
    }

    public function meta_sections() {
        global $calibrefx_current_section;

        calibrefx_clear_meta_section();

        calibrefx_add_meta_section('tosgen', __('TOS Generator', 'calibrefx'), '');

        do_action('more_other_setting');

        $calibrefx_current_section = 'tosgen';
        if (!empty($_GET['section'])) {
            $calibrefx_current_section = sanitize_text_field($_GET['section']);
        }
    }

    public function meta_boxes() {
        calibrefx_add_meta_box('tosgen', 'basic', 'calibrefx-other-settings-tosgen', __('TOS Generator', 'calibrefx'), array($this, 'tos_generator'), $this->pagehook, 'main', 'high');
    }

    public function tos_generator(){
        $name = '';
        $url = '';
        $info = '';


        $asp = '';
        $cn = '';
        $disclaimer = '';
        $dmca = '';
        $federal = '';
        $privacy = '';
        $social = '';
        $terms = '';


if(isset($_POST['name']) && isset($_POST['url']) ){

    $name = $_POST['name'];
    $url = $_POST['url'];
    $info = $_POST['info'];

    $asp = "Anti-Spam Policy

The following describes the Anti-Spam Policy for our $url website.

What Is Spam?
Spam is unsolicited email, also known as junk mail (received via email), or UCE (Unsolicited Commercial Email).  Virtually all of us have opened the inbox of an email account and found emails from an unknown sender.  By sending email only to those who have requested to receive it, we at $name are following accepted permission-based email guidelines.

What About The Laws Against Spam?
They exist.  However, as with any body of laws, any individual State spam statutes can and will vary.  The spam laws of each State can not only vary, but also have different definitions of unsolicited commercial email.  Additionally, there may be various federal agencies keeping track of spam, including the Federal Trade Commission (FTC).  At the Federal level, the CAN-SPAM Act of 2003 promulgates some attempt at a coherent and unified approach to unsolicited commercial email.  Ultimately, it would be difficult to enforce spam law violations on any consistent or pervasive basis, so your own vigilance is your own best first line of defense.  Beyond that, we protect you by ensuring that you are 100% in control of whether or not you ever hear from $name by email initially or in the future, as detailed in our “No Tolerance” policy below.

Our No Tolerance Anti-Spam Policy
WE HAVE A NO TOLERANCE SPAM POLICY.  We do not email unless someone has filled out an \"opt in\" form or \"webform\" expressing an interest in our information or products and/or services, or otherwise directly and proactively requesting it.  News of the features and benefits of Membership is spread through advertising, joint venture marketing, and word of mouth, so we are only building relationship with folks who wish to learn more about what we have to offer and willingly subscribe to our content and contact through email.  You are always completely in control of whether you receive email communication from $url, and can terminate at any time.

NOTE - Every auto-generated email contains a mandatory unsubscribe link that cannot be removed.  Therefore, each communication generated by $url carries with it the option to \"unsubscribe\" and never receive another email communication from $name.  



CHANGE NOTICE: As with any of our administrative and legal notice pages, the contents of this page can and will change over time.  Accordingly, this page could read differently as of your very next visit.  These changes are necessitated, and carried out by $name, in order to protect you and our $url website.  If this page is important to you, you should check back frequently as no other notice of changed content will be provided either before or after the change takes effect.

COPYRIGHT WARNING: The legal notices and administrative pages on this website, including this one, have been diligently drafted by an attorney.  We at $name have paid to license the use of these legal notices and administrative pages on $url for your protection and ours.  This material may not be used in any way for any reason and unauthorized use is policed via Copyscape to detect violators.

QUESTIONS/COMMENTS/CONCERNS: If you have any questions about the contents of this page, or simply wish to reach us for any other reason, you may do so by using our Contact information.

$info";



    $cn = "Copyright Notice

The following describes the Copyright Notice for our $url website.

The entire contents of our $name website are protected by intellectual property law, including international copyright and trademark laws.  The owner of the copyrights and/or trademarks are our website, and/or other third party licensors or related entities.

You do not own rights to any article, book, ebook, document, blog post, software, application, add-on, plugin, art, graphics, images, photos, video, webinar, recording or other materials viewed or listened to through or from our $url website or via email or by way of protected content in a membership site.  The posting of data on our website, such as a blog comment, does not change this fact and does not give you any right in the data.  You surrender any rights to your content once it becomes part of our website.

YOU MAY NOT MODIFY, COPY, REPRODUCE, REPUBLISH, UPLOAD, POST, TRANSMIT, OR DISTRIBUTE, IN ANY MANNER, THE MATERIAL ON OUR WEBSITE, INCLUDING TEXT, GRAPHICS, CODE AND/OR SOFTWARE.  You must retain all copyright and other proprietary notices contained in the original material on any copy you make of the material.  You may not sell or modify the material or reproduce, display, publicly perform, distribute, or otherwise use the material in any way for any public or commercial purpose.  The use of paid material on any other website or in a networked computer environment for any purpose is prohibited.  If you violate any of the terms or conditions, your permission to use the material automatically terminates and you must immediately destroy any copies you have made of the material.

You are granted a nonexclusive, nontransferable, revocable license to use our $url website only for private, personal, noncommercial reasons.  You may print and download portions of material from the different areas of the website solely for your own non-commercial use, provided that you agree not to change the content from its original form.  Moreover, you agree not to modify or delete any copyright or proprietary notices from the materials you print or download from $name.  Also note that any notice on any portion of our website that forbids printing & downloading trumps all prior statements and controls.

As a user at $url, you agree to use the products and services offered by our website in a manner consistent with all applicable local, state and federal laws and regulations.  No material shall be stored or transmitted which infringes or violates the rights of others, which is unlawful, obscene, profane, indecent or otherwise objectionable, threatening, defamatory, or invasive of privacy or publicity rights.

Our website prohibits conduct that might constitute a criminal offense, give rise to civil liability or otherwise violate any law.  Any activity that restricts or inhibits any other $name user from using the services of our website is also prohibited.  Unless allowed by a written agreement, you may not post or transmit advertising or commercial solicitation on our website. 



CHANGE NOTICE: As with any of our administrative and legal notice pages, the contents of this page can and will change over time.  Accordingly, this page could read differently as of your very next visit.  These changes are necessitated, and carried out by $name, in order to protect you and our $url website.  If this page is important to you, you should check back frequently as no other notice of changed content will be provided either before or after the change takes effect.

COPYRIGHT WARNING: The legal notices and administrative pages on this website, including this one, have been diligently drafted by an attorney.  We at $name have paid to license the use of these legal notices and administrative pages on $url for your protection and ours.  This material may not be used in any way for any reason and unauthorized use is policed via Copyscape to detect violators.

QUESTIONS/COMMENTS/CONCERNS: If you have any questions about the contents of this page, or simply wish to reach us for any other reason, you may do so by using our Contact information.

$info";




    $disclaimer = "Disclaimer

The following describes the Disclaimer for our $url website.

THIRD PARTY NOTICE: You understand, acknowledge, and accept the fact that we at $name are not affiliated with any company, person, or organization of any kind mentioned on this $url website in any way.  Company names, products, logos, trade marks and any other proprietary intellectual property or otherwise belongs to the rightful owner, which is not us.  You should not assume, even if a company name is in the website/domain name of this website, that there is an express, implied, or otherwise agreement, joint venture, partnership, or other relationship between us as website proprietors and any of these companies that are discussed merely for educational or other purposes.

The opinions, estimates, expectations, and projections contained in any disseminated information are accurate as of the date of release and are subject to change without additional notice. We do our best to ensure that the research has been compiled, obtained, discerned, or interpolated from reliable and trustworthy sources, and therefore believe the positions and beliefs shared are accurate and complete, though obviously not all material known or obtained will be contained, as distilling information into manageable quantity is in large part a goal.  We at $name are not responsible for any errors or omissions contained in any disseminated material and are not liable for any loss incurred as a result of using the material in any way.  The intent is merely to provide useful information, products, and services, some of which we may be compensated for.

Nothing offered by $name should be considered personalized investment advice. While our employees and/or contributors may answer your general customer service questions, they can not help you with specific investment questions and decisions, as they are not licensed under securities laws to deal with your particular investment situation. No communication by our employees and/or contributors to you should be construed as personal, individualized investment advice.  Investors should not rely on the information given by us to make investment decisions.  Rather, investors should use the information at $url only as a starting point, at most, to do additional independent research so that the investor is able to make his or her own investment decision.  You should consult with competent, professional help and read any available Prospectus or Public Company information.

This $url website contains or may contain \"forward looking statements\" within the meaning of Section 27A of the Securities Act of1933 and Section 21B of the Securities Exchange Act of1934.  Any statements that express or involve discussions with respect to predictions, expectations, beliefs, plans, projections, objectives, goals, assumptions or future events or performance are not statements of historical fact and may be \"forward looking statements.\"  Forward looking statements are based on expectations, estimates and projections at the time the statements are made that involve a number of risks and uncertainties which could cause actual results or events to differ materially from those presently anticipated.  Forward looking statements in this action may be identified through the use of words such as \"expects\", \"will,\" \"anticipates,\" \"estimates,\" \"believes,\" or statements indicating certain actions \"may,\" \"could,\" or \"might\" occur. 

Just as our website content does not constitute investment advice, and you should therefore consult a trained professional of your choosing, the same is true of other disciplines where expertise is gained through education, experience, and skill-building.  Thus, nothing on our website or otherwise disseminated by $name in conjunction with it should be taken as medical, legal, accounting or other such advice.  When in doubt, consult the hired help of your choosing, as you are ultimately responsible for your own affairs. 



CHANGE NOTICE: As with any of our administrative and legal notice pages, the contents of this page can and will change over time.  Accordingly, this page could read differently as of your very next visit.  These changes are necessitated, and carried out by $name, in order to protect you and our $url website.  If this page is important to you, you should check back frequently as no other notice of changed content will be provided either before or after the change takes effect.

COPYRIGHT WARNING: The legal notices and administrative pages on this website, including this one, have been diligently drafted by an attorney.  We at $name have paid to license the use of these legal notices and administrative pages on $url for your protection and ours.  This material may not be used in any way for any reason and unauthorized use is policed via Copyscape to detect violators.

QUESTIONS/COMMENTS/CONCERNS: If you have any questions about the contents of this page, or simply wish to reach us for any other reason, you may do so by using our Contact information.

$info";




    $dmca = "DMCA Compliance

The following describes the DMCA Compliance for our $url website.

We at $name are committed to responding to any alleged copyright violations, should they occur.  Notice of any alleged violation should take the form proposed by the U.S. Digital Millennium Copyright Act as revealed at http://www.copyright.gov.

Remedy
If any material infringes on the copyright of any offended party, we may remove the content from $url, prevent access to it, terminate or block access for those responsible for the content, and/or any other action deemed appropriate.  We may also pass along record of the incident for documentation and/or publication by third parties at our discretion.

Not Legal Advice/No Attorney-Client Relationship
If you believe your rights have been violated, it can be a serious matter.  This DMCA notice exists solely to effectuate our efforts, as website owners, to prevent and eliminate infringement on intellectual property rights.  It is no substitute for the assistance of competent legal counsel.  Other remedies and action, such as against an internet service provider (ISP), may exist.  You may wish to seek legal help immediately.

Notification
For your convenience and to speed resolution, notice of alleged infringement may be tendered to $name via email, using the email address and/or contact information provided on this website.  We warn that you will be liable for any and all statutory and common law damages, as well as court costs and attorney fees, if you falsify a claim that your copyrights have been violated. Six figure awards have already been granted for bogus complaints, so seeking the help of competent counsel is advised.

Assuming you still wish to assert copyright violation, you should provide the following to speed up the process:

STEP 1. Identify in adequate detail the copyrighted item you believe has been violated, by providing the URL to the protected work, ISBN#, or otherwise.
STEP 2. Identify the URL of the webpage that you assert is infringing the copyrighted work listed in item #1 above.
STEP 3. Provide contact information for yourself (email address is preferred, phone is suggested).
STEP 4. Provide information sufficient to allow us to notify the owner/administrator of the allegedly infringing webpage or other content such as a blog or forum posting (email address is preferred).
STEP 5. Include the following statement: \"I have a good faith belief that use of the copyrighted materials described above as allegedly infringing is not authorized by the copyright owner, its agent, or the law.\"
STEP 6. Include the following statement: \"I swear, under penalty of perjury, that the information in the notification is accurate and that I am the copyright owner or am authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.\"
STEP 7. Digitally sign your affirmation.

Counter-Notification
Note that the party representing the affected website or provider of content can issue a counter-notification under sections 512(g)(2) and (3) of the Digital Millennium Copyright Act, and so we may again post or link to the content in that case.
For your convenience, counter notification may be tendered via email, using the email address and/or contact information provided on this website.  We warn that you will be liable for any and all statutory and common law damages, as well as court costs and attorney fees, if you falsify a claim that others’ copyrights have NOT been violated

Assuming you still wish to file a counter-notice, you should provide the following to speed up the process:

STEP 1. Identify the specific URLs or other unique identifying information of material that we have removed or disabled access to.
STEP 2. Provide your name, address, telephone number, email address, and a statement that you consent to the jurisdiction of Federal District Court for the judicial district in which your address is located, and that you will accept service of process from the person who provided notification under subsection (c)(1)(C) or an agent of such person.
STEP 3. Include the following statement: \"I swear, under penalty of perjury, that I have a good faith belief that each item of content identified above was removed or disabled as a result of a mistake or misidentification of the material to be removed or disabled, or that the material identified by the complainant has been removed or disabled at the URL identified and will no longer be shown.\"
STEP 4. Digitally sign the affirmation. 



CHANGE NOTICE: As with any of our administrative and legal notice pages, the contents of this page can and will change over time.  Accordingly, this page could read differently as of your very next visit.  These changes are necessitated, and carried out by $name, in order to protect you and our $url website.  If this page is important to you, you should check back frequently as no other notice of changed content will be provided either before or after the change takes effect.

COPYRIGHT WARNING: The legal notices and administrative pages on this website, including this one, have been diligently drafted by an attorney.  We at $name have paid to license the use of these legal notices and administrative pages on $url for your protection and ours.  This material may not be used in any way for any reason and unauthorized use is policed via Copyscape to detect violators.

QUESTIONS/COMMENTS/CONCERNS: If you have any questions about the contents of this page, or simply wish to reach us for any other reason, you may do so by using our Contact information.

$info";





    $federal = "Federal Trade Commission Compliance

The following describes the Federal Trade Commission Compliance for our $url website.

We make every effort at candor regarding any products or services we use, recommend, or otherwise make mention of at $name. We strive to clearly differentiate between our own products or services versus those of third parties, to facilitate inquiries, support, and customer care. Likewise, just as we (and any other legitimate business) may profit from the sale of our own products or services, we may also profit from the sale of others’ products or services (like any retailer) at $url. Additionally, wherever products or services may give rise to income generation, we endeavor to provide realistic and factual data, but highlight the fact that the variables impacting results are so numerous and uncontrollable that no guarantees are in any way made. It is our goal to embrace the guidelines and requirements of the Federal Trade Commission (FTC) for the benefit of all, and with that in mind provide the following disclosures regarding compensation and disclaimer regarding earnings &amp; income.

Note that material connections may not be made known at every single advertisement or affiliate link. Thus, to be safe, you should simply assume there is a material connection and that we may receive compensation in money or otherwise for anything you purchase as a result of visiting this website, and also that we may be paid merely by you clicking any link.

Amazon.com
One or more parties affiliated or associated with our $name website in some way may be an Amazon.com affiliate. This means that links to products on Amazon.com, as well as reviews leading to purchases, can result in a commission being earned. Again, disclosure of this material connection and the potential for compensation may not be made at every single possible opportunity. To be safe, simply assume there is a material connection and potential for compensation at all times. While this does not imply skewed or unduly biased reviews, full disclosure calls for this warning.

Compensation
You should assume that we may be compensated for purchases of products or services mentioned on this $url website that are not created, owned, licensed, or otherwise materially controlled by us. Stated differently, while most people obviously understand that individuals make a living by way of the profit that remains after the costs associated with providing their product or service are covered, at least theoretically there may be someone out there who does not understand that a third party can \"affiliate\" someone else's products or services and be compensated by the product or service creator/owner for helping spread the word about their offering. Just compare it to retailers. They seldom produce anything, but rather make their money connecting product and service creators with end users.

Admonition
Having said that, you cannot count on anyone looking after your interests but you. So, you ought to always do your own research into various offers and opportunities, to the extent that leaves you comfortable, doing your own due diligence prior to making any purchase of any product or service from this $url website or any other. Here is a great set of guidelines for you to keep in mind:

First, just always operate from the position that any website proprietor, including us at $name, will have a material connection to the product or service provider, and may be compensated as a result of your purchase, unless expressly stated otherwise. Aside from your purchases, note that even you actions could result in earnings for this website. For instance, there could be ads displayed on this $url website that we are compensated for displaying whenever a website visitor clicks on them.

Second, to the extent that we have every interest in positively furthering our business relationship with you, we certainly desire to share only those offerings that we believe will benefit you. Just because we are not the founder or originator of the product or service, we are not going to withhold knowledge of this offering from you. If you can get some benefit from it, regardless of whether or not you've taken advantage of our own products and/or services, we want you to do well. Thus, we make a good faith effort to only present to you items that we either personally use, have actually tried, or else have faith in the reputation of the provider or concept. You can count on us making this determination based on all relevant and applicable information at the time of the recommendation.

Third, despite the fact that it would be counterproductive to mention products or services that you'll find disappointing or inferior, not only are people different, but it’s also possible for us to have a lapse in judgment. Thus, to be extra cautious, even if you believe in our good faith motives, you may as well go ahead and keep in mind that we could be at least partially influenced by the monetization factor of listing various products or services on our $url website. Furthermore, in that vein, the reality is that there are sometimes other connections between parties that are not monetary, such as personal capital, goodwill, or otherwise, that could be an underlying undercurrent swaying the decision to promote a particular offering. Due to this hypothetical possibility, you should again simply nor rely solely on what we have to say, but rather just form your own independent opinion just to be safe. Finally, bear in mind that we might also receive free products or services, gifts, or review copies of items too.

Testimonials
Testimonials regarding the outcome or performance of using any product or service are provided to embellish your understanding of the offering. While great effort is made to ensure that they are factually honest, we at $name are not liable for errors and omissions. Aside from human error, some information may be provided by third parties, such as customers or product/service providers. The best results are not uncommonly correlated with the best efforts, discipline, diligence, and so on, and thus the results depicted cannot, in any way, be construed as common, typical, expected, normal, or associated with the average user’s experience with any given product or service. Exceptional results may be depicted by our website as highlights, but you are responsible for understanding that atypical outcomes may not reflect your experience. Aside from market conditions, products and services change over time. Older products may lose effectiveness. Newer products may not have a reliable track record.

Where products or services might pertain to earning money, the same safeguards about use of testimonials apply. Additionally, note that any related income figures are highly specific to the individual or entity that produced those results, and there can be no assurance that you will be able to leverage the same, or similar, products or services to achieve comparable results. The results, though real, may be the result of the conflation of a number of favorable circumstances that would be difficult to replicate, and so you must proceed with the knowledge that your outcome can differ from any shared on our website.

Professional Consultation
Many products and services are designed to solve problems. Common problem areas include legal, financial, and medical. We are in no way purporting to counsel you on issues related law, finances, or health. If you require guidance in these arenas, you should consider securing your own counsel from lawyers, accountants, tax professionals, investment advisors, or medical professionals before taking any action. Nothing we may ever communicate at $name, in print or spoken word, will ever be intended to constitute any such counsel, as we do not claim to be professionals in any of those disciplines. You assume all risk for actions taken, losses incurred, damages sustained, or other issues stemming from your use of any product or service in any way connected with or mentioned on this website. Indeed, such decision is solely your own, or else determined in conjunction with the professional guidance of the advisor of your choosing.

Use Of Products &amp; Services
The following are facts you should be advised of if you intend to take advantage of any products or services.

The price paid for products and services change over time. Even the prices of staples and basic commodities change, and there are many factors such as supply and demand, sales and other customer acquisition incentives, and more. Price, and value, can be quite relative. Technology, innovations, product improvements, market penetration, and numerous other factors all weigh in. It is impossible to define the “right” price for any product and service. Willing buyers and willing sellers determine price at any given time. You accept the fact that your purchase reflects your own attribution of value at the time of purchase, and that the price may increase or decrease in the future.

The outcome you experience is dependent upon many factors. Aptitude and attitude go a long way towards success with products and services in virtually any niche, whether fitness or making money. Circumstances, experience, innate abilities, personality, education, time commitments, and perseverance are just a few factors. Given the smorgasbord of interrelated variables, there is no way to reasonably predict your specific outcome with any degree of reliability or certainty.

Income-Producing Products &amp; Services
Income-producing products &amp; services are likewise subject to the above cautions. In addition, however, there are additional factors we like to point out at $name. Unlike weight loss products or self-help materials, income-producing methods are influenced by the overall health of the economy in which one operates. In times of liquidity, money flows freely and commerce is easier. In times of perceived scarcity, fear, recession, depression, or otherwise, commerce is stymied. Results can be influenced by market sentiment, just as the stock market indices around the world are swayed heavily on news.

Income-producing products &amp; services purchased should be viewed as just that – purchases. Though they can be investments in one’s business, it is not unreasonable to expect that there may not be an express return on that investment, per se. Often, business success is the convergence of a number of factors, methods, strategies, and so on. It can be hard to peg success to one method or machination. This does not necessarily undermine value of any given product or service, as it can have an additive effect. Or, it may have no effect. Since it can be difficult to tell, you should operate on the assumption that your outcome could be zero. We make no guarantees and you should only risk what you can afford to lose on any purchases on or through $url.

Earnings &amp; Income
In light of all of the factors above, impinging on the very nature of income-producing products and services, there is no way to guarantee results of any kind whatsoever. Accordingly, we affirmatively declare that we make no guarantees as to your earnings &amp; income of any kind, at any time.

As with any business endeavor or investment, past performance is no guarantee or predictor of future performance. Any testimonials or other representations of results are for illustrative purposes only and, though every effort is made to ensure they’re factually honest, they are not intended to imply or insinuate what is likely to happen with you. Your reliance on them as such is not advised.

It should be noted that “earnings &amp; income” is so phrased with specific intent. While income may typify the earnings most either seek or are accustomed to, earnings can come in non-monetary forms. These include some forms that are abstract or intangible, and thus not even readily converted to currency or a common medium of exchange. Thus, note that all manner of compensation, including earnings of a non-income yet nevertheless beneficial form, are covered by these provisions.

Affiliates &amp; Other Third Parties
It should also be noted that we only have control over, and thus only accept responsibility for, the content of this $url website authored by us. Any representations made by others should be considered prima facie unauthorized. You may also read, hear, or otherwise come into contact with commentary about any of our products &amp; services or offerings, and should assume those have likewise not been authorized.

While information, in any form, can arise, at any time, regarding our products &amp; services, there may be times when this results from an affiliate relationship. In other words, we may permit our products &amp; services to be marketed through other individuals, businesses, websites, and otherwise, just as providers of goods and services use retailers and other vendors to make available what they offer.

You should not construe a third-party offer as an endorsement by that third party of any product or service. You should, more conservatively, view it as an offer to buy something. Likewise, as alluded to previously, note that we cannot fully control all marketing practices by all parties. With the use of “mirror” sites, indirect or unauthorized affiliates, “tiered” affiliate structures, and so on, policing the world wide web with any modicum of thoroughness is unlikely. We make reasonable efforts to ensure our affiliates comply with our policies and represent our products &amp; services consistent with our guidelines. However, at $name we cannot always guarantee they will do so. You are always free to report concerns or abuses via our Contact information.

Customer Care
Last, but not least, please note that our role in briefing you on products and services other than our own is simply as a \"matchmaker.\" We do not provide any support or customer service for those items and you should always contact the owner or provider of those products or services to have any and all questions answered to your satisfaction before purchasing.

&nbsp;

CHANGE NOTICE: As with any of our administrative and legal notice pages, the contents of this page can and will change over time. Accordingly, this page could read differently as of your very next visit. These changes are necessitated, and carried out by $name, in order to protect you and our $url website. If this page is important to you, you should check back frequently as no other notice of changed content will be provided either before or after the change takes effect.

COPYRIGHT WARNING: The legal notices and administrative pages on this website, including this one, have been diligently drafted by an attorney. We at $name have paid to license the use of these legal notices and administrative pages on $url for your protection and ours. This material may not be used in any way for any reason and unauthorized use is policed via Copyscape to detect violators.

QUESTIONS/COMMENTS/CONCERNS: If you have any questions about the contents of this page, or simply wish to reach us for any other reason, you may do so by using our Contact information.

$info";





    $privacy = "Privacy Policy

The following describes the Privacy Policy for our $url website.

Your Privacy
Your privacy is important to us at $name. To better protect your privacy we provide this notice explaining our online information practices and the choices you can make about the way your information is collected and used. You agree to agree to these policies by virtue of using our website in a way that leads to you providing us with personal information.

State Law &amp; Accompanying Rights
Please understand that you may have additional rights originating from State laws based on where you live. These State-based rights may augment, strengthen, or otherwise somehow compliment any privacy rights you have inherently or under Federal law. Our policy is to comply fully with the privacy policies of every jurisdiction in which we operate. Accordingly, you are free to use our Contact information to reach us at any time to assert any State rights.

Our Commitment To Children's Privacy
Protecting the privacy of the very young is especially important. For that reason, our website will never collect or maintain information at our website from those we actually know are under 18, and no part of our website is structured to attract anyone under 18.

Under our Terms of Service and Conditions of Use, children under 18 are not allowed to use our website and access our services. It is not our intention to offer products or services to minors.

Collection of Personal Information
When visiting our website, the IP address used to access our website may be logged along with the dates and times of access. This information is purely used to analyze trends, administer our website, track users movement, and gather broad demographic information for internal use such as statistical assessments and website improvement. Most importantly, any recorded IP addresses are not linked to personally identifiable information.

Other information may be collected as well by $name, which is rather typical of most websites. For instance, the source that referred you to our website is generally known. Likewise, your duration on our website, and your destination when you leave our website can also be tracked. Other common data collected includes the type of operating system the computer you are using to access our website has. Similarly, the type of web browser is often noted. Again, this is common data collection, and helps ultimately produce a better end-user experience.

Cookies are another common internet practice. Cookies are a key means of improving user experience by allows us to customize your use of our website. Simple information is transferred to your computer to allow the content and experience at $url to reflect your actions, preferences, and so on. You should simply make the assumption our website uses cookies, and note that you are free to make adjustments in your web browser to disable these or otherwise receive notification of cookies so you can take whatever desired action you so choose. Please understand that refusing cookies may cripple some of our website features and render some aspects useless to you.

At times, you will be fully aware of information received, as you are the direct source providing it. For instance, you may comment on a blog post, reply to an email (whether broadcast message or autoresponder), provide an email address, complete a survey, requests SMS, or otherwise. Likewise, purchases necessarily involve collecting certain information, such as credit card information, Paypal addresses, your physical address for billing and/or shipping, phone number, and so on. Refusing to provide some of this information may lead to us being unable to provide you with the products or services you’ve requested.

A prime example of limited access to our website is where some $url content may be protected by a username and password. Whether a username and password is generated by our website, or created by you, these will almost always be connected with some other information related to or connected with you. This is true since much content that is protected on the internet is subscription based, often paid for. Thus, the username and password must necessarily be tied to your other account data. Usernames and passwords, by their very nature, should be kept private.

Handling of Personal Information
Note that any personal information you provide to others apart from us or our vendors is wholly optional. As an example, you might disclose something in a blog post comment. That “private” information is now “public,” and we have no control over that. In like fashion, you sharing information with any other third party not functioning as a service provider to us puts that information beyond our control and becomes subject to the policy that party has in place.

Our primary intention for collecting personal and private information from you is simply to conduct our business. We can use this internally to better serve you. Accordingly, we see no reason to share your personal information to other parties and outside interests unless you have authorized us to do so. Of course, there are instances where your information is stored with third party service providers, such as email service providers, as they provide services that are industry-leading in quality and security and are far more beneficial to our end user than attempting such services “in-house.” However, you are never required to deal with any such third party directly, they are limited in how they use your information, and they cannot sell or transfer it to others in any way.

However, of course, your information does comprise part of an overall whole. This aggregate of information, by contrast, may be used to understand our overall user base. Further, we may share this information about our website visitors as a whole, not individually, with third parties for various purposes, in our sole discretion.

While we are staunch privacy advocates at $name, there are times when even we may be forced to abandon these ideals. Just as major search engines face ongoing compulsion to provide data against their will, so too may the same occur with our $url website. Illegal activity or other serious acts or allegations could create legal liability for our website. In those cases, we reserve the right to share your information, or else may simply be compelled to do so by law. On the other hand, there may be times when we would need to share your private information in order to protect our own interests. For instance, in cases of suspected or alleged copyright infringement or other intellectual property violations, it may be necessary to share personal information.

Google Adsense and the DoubleClick DART Cookie
Google, as a third party advertisement vendor, may use cookies to serve ads on this $url website. The use of DART cookies by Google enables them to serve adverts to visitors that are based on their visits to this website, including past visits, as well as other websites on the internet.

To opt out of the DART cookies you may visit the Google ad and content network privacy policy at the following url http://www.google.com/privacy_ads.html Tracking of users through the DART cookie mechanisms are subject to Google's own privacy policies.

Other Third Party ad servers or ad networks may also use cookies to track users activities on this website to measure advertisement effectiveness and other reasons that will be provided in their own privacy policies, our website has no access or control over these cookies that may be used by third party advertisers. However, you can opt out of some, though likely not all, of these cookies in one easy location at http://ww.networkadvertising.org/managing/opt_out.asp

Links to Third Party Websites
We have included links on this website for your use and reference. We are not responsible for the privacy policies on these websites. You should be aware that the privacy policies of these websites may differ from our own.

&nbsp;

CHANGE NOTICE: As with any of our administrative and legal notice pages, the contents of this page can and will change over time. Accordingly, this page could read differently as of your very next visit. These changes are necessitated, and carried out by $name, in order to protect you and our $url website. If this page is important to you, you should check back frequently as no other notice of changed content will be provided either before or after the change takes effect.

COPYRIGHT WARNING: The legal notices and administrative pages on this website, including this one, have been diligently drafted by an attorney. We at $name have paid to license the use of these legal notices and administrative pages on $url for your protection and ours. This material may not be used in any way for any reason and unauthorized use is policed via Copyscape to detect violators.

QUESTIONS/COMMENTS/CONCERNS: If you have any questions about the contents of this page, or simply wish to reach us for any other reason, you may do so by using our Contact information.

$info";






    $social = "Social Media Disclosure

The following describes the Social Media Disclosure for our $url website.

Social Media Issue
We live in an interesting time when privacy rights are championed alongside an unprecedented voluntary willingness of people to share their most intimate and superfluous life details with the world, even in places such as our $name website. While apparently benign on the surface, the dangers of unrestrained public disclosure of sensitive information is beginning to surface.

Key social media players are being sued for unauthorized or abusive use/misuse of personal information. Failure to protect and warn are likely going to be focal factors. Lawsuits are filed seeking damages for statements held to be responsible for people's death or suicide. Bloggers presuming to operate under an unfettered freedom of speech or greater latitude offered to members of the press are losing civil cases for defamation, slander, libel, and so on.

As social media rapidly advances to allow more technologically sophisticated and easy dissemination, the simultaneous fallout of revelation without boundaries is mounting. Thus, a sober approach to the benefits of social media, while sidestepping the perils of imprudent disclosure, can facilitate an enjoyable online experience, without the consequences of excess, in settings such as our own $url website.

Presence/Scope of Social Media
You should assume that social media is in use on our $name website. A simple click of a button to endorse a person, product, or service is building a cumulative profile about you, which you should always assume can be discovered by others. Attempting to share a website with someone, whether by direct press of a button or else by email forwarding facilitated on a website, you should assume that this may not stop with the intended recipient, and that this can generate information about you that could be seen by a veritable infinite number of people. Such a domino effect could initiate right here on our $url website.

Something as simple as a blog comment provides the opportunity for knee-jerk reactions that can become public and may not truly represent a position (at least in strength or severity) that you might hold after a period of more reasoned contemplation. You should also note that the ease of accessing one site through the login credentials of another, or the use of a global login for access to multiple sites can accumulate a dossier on you and your online behavior that may reveal more information to unintended parties than you might realize or want. Any or all of these features could exist on our $name website at one time or another.

These few examples illustrate some possible ways that social media can exist, though it is not an exhaustive list and new technologies will render this list outdated quickly. The objective is to realize the reach of social media, its widespread presence on websites in various forms (including this website), and develop a responsible approach to using it.

Protecting Others
You should recognize the fact that divulgences made in and on social media platforms on this website and others are rarely constrained just to you. Disclosures are commonly made about group matters that necessarily affect and impact other people. Other disclosures are expressly about third parties, sometimes with little discretion. What can appear funny in one moment can be tragic in the next. And a subtle \"public\" retaliation can have lifetime repercussions.

Ideal use of social media on our website would confine your disclosures primarily to matters pertaining to you, not others. If in doubt, it's best to err on the side of non-disclosure. It's doubtful the disclosure is so meaningful that it cannot be offset by the precaution of acting to protect the best interests of someone who is involuntarily being exposed by your decision to disclose something on our $url website (or another).

Protecting Yourself
You should likewise pause to consider the long-term effects of a split-second decision to publicly share private information about yourself on our $name website. Opinions, likes, dislikes, preferences, and otherwise can change. Openly divulging perspectives that you hold today, may conflict with your developing views into the futures. Yet, the \"new you\" will always stand juxtaposed against the prior declarations you made that are now concretized as part of your public profile. While the contents of your breakfast may hold little long-term impact, other data likewise readily shared can have consequences that could conceivably impact your ability to obtain certain employment or hinder other life experiences and ambitions.

As with sharing information about other people, extreme caution should be used before revealing information about yourself. If in doubt, it's likely best not to do it. The short term gain, if any, could readily be outweighed by later consequences. Finally, you should note that we are not responsible for removing content once shared, and we may not be able to do so.

Restrictions on Use of Social Media Data
You, as a visitor to our $url website, are not permitted to \"mine\" social media or other platforms contained herein for personal information related to others. Even where people have publicly displayed data, you should not construe that as though you have the liberty to capture, reproduce, or reuse that information. Any use of social media or related platforms on our website are for interactive use only, relevant only during the website visit.

Accuracy of Social Media Data
As any social media platform is built on user-generated content, you should consider this fact in seeking to determine the authenticity of anything you read. We are not responsible for verifying any user-generated content for accuracy. A best practices policy would be to view all such content as strictly opinion, not fact.

Potential Issues of Liability
You should also be mindful of the fact that your words could trigger liability for harm caused to others. While you have the right to free speech, you do not have the right to damage other people. Under basic principles of tort law, you are always responsible, personally, for situations where either:

1. you were required to act, but did not (i.e. - some \"duty of care\")
2. your were required to refrain from acting, but did not (i.e. - slander, defamation, etc.)

These \"sins of omission and commission\" could cause problems for you, irrespective of whether you assert you are conducting business under the guise of one or more business entities. Illegal and unethical conduct, when done in the name of a corporation or LLC, is still illegal and unethical conduct. As it is rarely part of a business plan to engage in illegal and unethical conduct, you are doubtfully operating in any official capacity, but rather, perhaps, leveraging that capacity to effectuate personal wrongdoing. You should consult a licensed attorney if you wish legal advice as to the (potential) ramification of your situation or legal problems stemming from this website or another.
CHANGE NOTICE: As with any of our administrative and legal notice pages, the contents of this page can and will change over time. Accordingly, this page could read differently as of your very next visit. These changes are necessitated, and carried out by $name, in order to protect you and our $url website. If this page is important to you, you should check back frequently as no other notice of changed content will be provided either before or after the change takes effect.

COPYRIGHT WARNING: The legal notices and administrative pages on this website, including this one, have been diligently drafted by an attorney. We at $name have paid to license the use of these legal notices and administrative pages on $url for your protection and ours. This material may not be used in any way for any reason and unauthorized use is policed via Copyscape to detect violators.

QUESTIONS/COMMENTS/CONCERNS: If you have any questions about the contents of this page, or simply wish to reach us for any other reason, you may do so by using our Contact information.

$info";






    $terms = "Terms Of Service &amp; Conditions Of Use

The following describes the Terms of Service Conditions of Use for our $url website.

PLEASE READ THIS DOCUMENT CAREFULLY BEFORE ACCESSING OR USING OUR WEBSITE. BY ACCESSING OR USING OUR WEBSITE, YOU AGREE TO BE BOUND BY THE TERMS AND CONDITIONS SET FORTH BELOW. IF YOU DO NOT WISH TO BE BOUND BY THESE TERMS AND CONDITIONS, YOU MAY NOT ACCESS OR USE OUR WEBSITE. IF YOU DO NOT UNDERSTAND THESE TERMS AND CONDITIONS, DO NOT USE OUR WEBSITE. WE MAY MODIFY THIS AGREEMENT AT ANY TIME WITHOUT INDIVIDUAL, SPECIFIC NOTICE TO YOU, AND SUCH MODIFICATIONS SHALL BE EFFECTIVE IMMEDIATELY UPON POSTING OF THE MODIFIED AGREEMENT ON OUR WEBSITE. YOU AGREE TO REVIEW THE AGREEMENT PERIODICALLY TO BE AWARE OF SUCH MODIFICATIONS AND YOUR CONTINUED ACCESS OR USE OF OUR WEBSITE AFTER SUCH NOTICE SHALL BE DEEMED YOUR CONCLUSIVE ACCEPTANCE OF THE MODIFIED AGREEMENT, INCLUDING ANY AND ALL MODIFICATIONS, ADDITIONS, DELETIONS, OR OTHER CHANGES.

OUR WEBSITE AND CONTENT ARE PROVIDED ON AN 'AS IS' BASIS WITHOUT ANY WARRANTIES OF ANY KIND. OUR WEBSITE AND ITS SUPPLIERS, TO THE FULLEST EXTENT PERMITTED BY LAW, DISCLAIM ALL WARRANTIES, INCLUDING (BUT NOT LIMITED TO) THE WARRANTY OF MERCHANTABILITY, NON-INFRINGEMENT OF THIRD PARTIES RIGHTS, AND THE WARRANTY OF FITNESS FOR PARTICULAR PURPOSE. OUR WEBSITE AND ITS SUPPLIERS MAKE NO WARRANTIES ABOUT THE ACCURACY, RELIABILITY, COMPLETENESS, OR TIMELINESS OF THE CONTENT, SERVICES, SOFTWARE TEXT, GRAPHICS, AND LINKS.

By using this website, you agree to obey these Terms of Service and Conditions of Use. Please read them carefully.

Our $name website (and other “internal” websites stemming from it, such as specific membership sites or webpages pertinent to the main website or weblog) is an online (and, periodically, offline) information service and is subject to your compliance with the terms and conditions set forth below (all parts and parties collectively referred to as our website).

Any other policies, notices, or other legal/administrative pages contained in our website are necessarily incorporated into these Terms of Service and Conditions of Use. This may include, without limitation, a DMCA Policy, Privacy Policy, Disclaimer, Copyright Notice, Anti-Spam Policy, and FTC Compliance Policy.

You agree to obey all applicable laws and regulations regarding your use of our $url website and the content and materials provided in it.

Our website is an independent, stand-alone entity that has no relationship, connection, or affiliation whatsoever with any company, person, outfit, organization, or group mentioned herein, even if such name appears in our website name, domain, URL, or otherwise. You should assume no other party, by mere mention of their name, has endorsed anything you see here. The aim is simply to provide useful resources for our readers, some of which we may be compensated for. You should simply assume at all times we are being compensated and, while that may not prompt us to make unsound recommendations, you should always be responsible for your own financial decisions, be it investing, purchasing, donating, or otherwise.

&nbsp;

1. Copyright, Licenses and Idea/User Submissions.
The following describes the Copyright Notice for our website.

The entire contents of our website are protected by intellectual property law, including international copyright and trademark laws. The owner of the copyrights and/or trademarks are our website, and/or other third party licensors or related entities.

You do not own rights to any article, book, ebook, document, blog post, software, application, add-on, plugin, art, graphics, images, photos, video, webinar, recording or other materials viewed or listened to through or from our $name website or via email or by way of protected content in a membership site. The posting of data on our website, such as a blog comment, does not change this fact and does not give you any right in the data. You surrender any rights to your content once it becomes part of our website.

YOU MAY NOT MODIFY, COPY, REPRODUCE, REPUBLISH, UPLOAD, POST, TRANSMIT, OR DISTRIBUTE, IN ANY MANNER, THE CONTENT ON OUR WEBSITE, INCLUDING TEXT, GRAPHICS, CODE AND/OR SOFTWARE. You must retain all copyright and other proprietary notices contained in the original content on any copy you make of the content. You may not sell or modify the content or reproduce, display, publicly perform, distribute, or otherwise use the content in any way for any public or commercial purpose. The use of paid content on any other website or in a networked computer environment for any purpose is prohibited. If you violate any of the terms or conditions, your permission to use the content automatically terminates and you must immediately destroy any copies you have made of the content.

You are granted a nonexclusive, nontransferable, revocable license to use our website only for private, personal, noncommercial reasons. You may print and download portions of material from the different areas of the website solely for your own non-commercial use, provided that you agree not to change the content from its original form. Moreover, you agree not to modify or delete any copyright or proprietary notices from the materials you print or download. Also note that any notice on any portion of our website that forbids printing &amp; downloading trumps all prior statements and controls.

As a user, you agree to use the products and services offered by our website in a manner consistent with all applicable local, state and federal laws and regulations. No material shall be stored or transmitted which infringes or violates the rights of others, which is unlawful, obscene, profane, indecent or otherwise objectionable, threatening, defamatory, or invasive of privacy or publicity rights.

Our $url website prohibits conduct that might constitute a criminal offense, give rise to civil liability or otherwise violate any law. Any activity that restricts or inhibits any other user from using the services of our website is also prohibited. Unless allowed by a written agreement, you may not post or transmit advertising or commercial solicitation on our website.

You agree to grant to our website a non-exclusive, royalty-free, worldwide, irrevocable, perpetual license, with the right to sub-license, to reproduce, distribute, transmit, create derivative works of, publicly display and publicly perform any materials and other information (including, without limitation, ideas contained therein for new or improved products and services) you submit to any public areas of our website (such as bulletin boards, forums, blog, and newsgroups) or by e-mail to our website by all means and in any media now known or hereafter developed. You also grant to our website the right to use your name in connection with the submitted materials and other information as well as in connection with all advertising, marketing and promotional material related thereto. You agree that you shall have no recourse against our website for any alleged or actual infringement or misappropriation of any proprietary right in your communications to our website.

Trademarks
Publications, products, content or services referenced herein or on our website are the exclusive trademarks or servicemarks of our $name website or related parties. Other product and company names mentioned in our website may be the trademarks of their respective owners.

Links to Our Website
You may provide links to our website, provided you do not change, remove, or obscure the copyright notice or other notices on our website. Your website or other source of links must not engage in illegal or pornographic activities. Finally, you may link provided you understand that you must stop linking to our website immediately upon request by our website.

2. Use of our website.
You agree, acknowledge, and accept that we are not trained professionals and do not purport to render professional or expert advice in any arena.

Data contained on or made available through our $url website is not intended to be, and does not constitute, legal advice. Our website, and your use of it, does not create an attorney-client relationship. We do not warrant or guarantee the accuracy, adequacy, or recency of the data contained in or linked to our website.

Data contained on or made available through our website is not intended to be, and does not constitute, medical or health advice. Our website, and your use of it, does not create a physician-patient relationship. We do not warrant or guarantee the accuracy, adequacy, or recency of the data contained in or linked to our website.

Data contained on or made available through our website is not intended to be, and does not constitute, financial/investing advice. Our website, and your use of it, does not create an advisor-client relationship. We do not warrant or guarantee the accuracy, adequacy, or recency of the data contained in or linked to our website.

Your use of our $name website or materials linked to our website is completely at your own risk. You should not act or depend on any data on our website, where applicable, without seeking the counsel of a competent lawyer licensed to practice in your jurisdiction for your particular legal issues. You should not act or depend on any data on our website, where applicable, without seeking the counsel of a competent physician licensed to practice in your jurisdiction for your particular medical issues. You should not act or depend on any data on our website, where applicable, without seeking the counsel of a competent financial advisor licensed to practice in your jurisdiction for your particular financial needs and issues.
We may make changes to the features, functionality or content of our website at any time. We reserve the right in our sole discretion to edit or delete any data appearing on our website.

Your Duty To Other Users
Your use of our website is for your own personal, non-commercial benefit. In no way are you to leverage our website in a way that mines for the personal information of other, whether in blog comments or otherwise, for your own use or for the benefit of others. This includes, but is not limited to, spam (unsolicited commercial email).

If you inadvertently obtain personal information about other users, you shall not share this with anyone else.

Restricted access
Access to certain areas of our $url website is restricted. We reserve the right to restrict access to other areas of our website, or indeed our whole website, at our discretion.

If we provide you with a user ID (username) and password to enable you to access restricted areas of our website or other content or services, you must ensure that that user ID and password is kept confidential. You may not share your user ID and/or password with anyone for any reason, either directly or indirectly. You accept responsibility for all activities that occur under your user ID or password.

We may disable your user ID and password at our sole discretion or if you breach any of the policies or terms governing your use of our $name website or any other contractual obligation you owe to us.

Third-Party Products/Services
You understand that, except for information, products or services clearly identified as being supplied by our website, our website does not operate, control or endorse any information, products or services on the Internet in any way. Except for information identified by our website as such, all information, products and services offered through our website or on the Internet generally are offered by third parties that are not affiliated with our website, and we may be compensated.

Viruses, etc.
You also understand that our $name website cannot and does not guarantee or warrant that files available for downloading through our website will be free of infection or viruses, worms, Trojan horses or other code that manifest contaminating or destructive properties. You are responsible for implementing sufficient procedures and checkpoints to satisfy your particular requirements for accuracy of data input and output, and for maintaining a means external to our website for the reconstruction of any lost data.

Assumption of Risk
YOU ASSUME TOTAL RESPONSIBILITY AND RISK FOR YOUR USE OF OUR WEBSITE AND THE INTERNET. OUR WEBSITE PROVIDES OUR WEBSITE AND RELATED INFORMATION \"AS IS\" AND DOES NOT MAKE ANY EXPRESS OR IMPLIED WARRANTIES, REPRESENTATIONS OR ENDORSEMENTS WHATSOEVER (INCLUDING WITHOUT LIMITATION WARRANTIES OF TITLE OR NONINFRINGEMENT, OR THE IMPLIED WARRANTIES OF MERCHANTABILITY OR FITNESS FOR A PARTICULAR PURPOSE) WITH REGARD TO THE PRODUCT OR SERVICE, ANY MERCHANDISE INFORMATION OR SERVICE PROVIDED THROUGH THE SERVICE OR ON THE INTERNET GENERALLY, AND OUR WEBSITE SHALL NOT BE LIABLE FOR ANY COST OR DAMAGE ARISING EITHER DIRECTLY OR INDIRECTLY FROM ANY SUCH TRANSACTION. IT IS SOLELY YOUR RESPONSIBILITY TO EVALUATE THE ACCURACY, COMPLETENESS AND USEFULNESS OF ALL OPINIONS, ADVICE, SERVICES, MERCHANDISE AND OTHER INFORMATION PROVIDED THROUGH THE SERVICE OR ON THE INTERNET GENERALLY. OUR WEBSITE DOES NOT WARRANT THAT THE SERVICE WILL BE UNINTERRUPTED OR ERROR-FREE OR THAT DEFECTS IN THE SERVICE WILL BE CORRECTED.

YOU UNDERSTAND FURTHER THAT THE PURE NATURE OF THE INTERNET CONTAINS UNEDITED MATERIALS SOME OF WHICH ARE SEXUALLY EXPLICIT OR MAY BE OFFENSIVE TO YOU. YOUR ACCESS TO SUCH MATERIALS IS AT YOUR RISK. OUR WEBSITE HAS NO CONTROL OVER AND ACCEPTS NO RESPONSIBILITY WHATSOEVER FOR SUCH MATERIALS YOU MIGHT SOMEHOW ACCESS.

Limitation of Liability
The content may contain inaccuracies or typographical errors. Our $url website makes no representations about the accuracy, reliability, completeness, or timeliness of the content or about the results to be obtained from using our website or the content on it. Use of our website and the content is at your own risk. Changes are periodically made to our website, and may be made at any time.

OUR WEBSITE DOES NOT WARRANT THAT OUR WEBSITE WILL OPERATE ERROR-FREE OR THAT OUR WEBSITE AND ITS SERVER ARE FREE OF COMPUTER VIRUSES AND OTHER HARMFUL GOODS OR CONDITIONS. IF YOUR USE OF OUR WEBSITE OR THE CONTENT RESULTS IN THE NEED FOR SERVICING OR REPLACING EQUIPMENT OR DATA, OUR WEBSITE IS NOT RESPONSIBLE FOR THOSE COSTS.

Express Disclaimer of Consequential Damages
IN NO EVENT WILL OUR WEBSITE, ITS SUPPLIERS, OR ANY THIRD PARTIES MENTIONED AT OUR WEBSITE BE LIABLE FOR (I) ANY INCIDENTAL, CONSEQUENTIAL, INDIRECT OR OTHER DAMAGES (INCLUDING, BUT NOT LIMITED TO, DAMAGES FOR LOSS OF PROFITS, BUSINESS INTERRUPTION, LOSS OF PROGRAMS OR INFORMATION, AND THE LIKE) ARISING OUT OF THE USE OF OR INABILITY TO USE THE SERVICE, OR ANY INFORMATION, OR TRANSACTIONS PROVIDED ON THE SERVICE, OR DOWNLOADED FROM THE SERVICE, OR ANY DELAY OF SUCH INFORMATION OR SERVICE. EVEN IF OUR WEBSITE OR ITS AUTHORIZED REPRESENTATIVES HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES, OR (II) ANY CLAIM ATTRIBUTABLE TO ERRORS, OMISSIONS, OR OTHER INACCURACIES IN THE SERVICE AND/OR MATERIALS OR INFORMATION DOWNLOADED THROUGH THE SERVICE.
BECAUSE SOME STATES DO NOT ALLOW THE EXCLUSION OR LIMITATION OF LIABILITY FOR CONSEQUENTIAL OR INCIDENTAL DAMAGES, THE ABOVE LIMITATION MAY NOT APPLY TO YOU. IN SUCH STATES, LIABILITY IS LIMITED TO THE GREATEST EXTENT PERMITTED BY LAW, RESULTING IN THE SMALLEST DOLLAR AMOUNT PERMITTED FOR THE AGGREGATE LIABILITY FOR BOTH OUR WEBSITE AND AFFILIATED PARTIES FOR A CLAIM DERIVING FROM OR RELATED TO OUR WEBSITE. THIS IS IN PLACE OF ANY AND ALL OTHER REMEDIES OTHERWISE AVAILABLE.

Links to Other Websites.
Our website contains links to third party Websites. Our $name website makes no representations whatsoever about any other website which you may access through this one or which may link to this website. When you access a website from our website, please understand that it is independent from our website, and that our website has no control over the content on that website. These links are provided solely as a convenience to you and not as an endorsement by our website of the contents on such third-party Websites. Our website is not responsible for the content of linked third-party Websites and does not make any representations regarding the content or accuracy of material on such third party Websites. If you decide to access linked third-party Websites, you do so at your own risk. We do not necessarily endorse, recommend, suggest or otherwise make any overture or prompt for action regarding any product or service offered. You should assume we are compensated for any purchases you make. Again, any income claims should be construed as atypical results and you assume the risk that inferior results obtain, including losses, for which we carry no responsibility or liability.

User Submissions
As a user of our $url website, you are responsible for your own communications and are responsible for the consequences of their posting. You must not do the following things: post material that is copyrighted, unless you are the copyright owner or have the permission of the copyright owner to post it; post material that reveals trade secrets, unless you own them or have the permission of the owner; post material that infringes on any other intellectual property rights of others or on the privacy or publicity rights of others; post material that is obscene, profane, defamatory, threatening, harassing, abusive, hateful, or embarrassing to another user of our website or any other person or entity; post a sexually-explicit image; post advertisements or solicitations of business; post chain letters or pyramid schemes; or impersonate another person.

Our website does not represent or guarantee the truthfulness, accuracy, or reliability of any communications posted by other users of our website or endorse any opinions expressed by users of our website. You acknowledge that any reliance on material posted by other users of our website will be at your own risk.

Our $name website does not necessarily screen communications in advance and is not responsible for screening or monitoring material posted by users of our website. If observed by our website and/or notified by a user of communications which allegedly do not conform to this agreement, our website may investigate the allegation and determine in good faith and its sole discretion whether to remove or request the removal of the communication. Our website has no liability or responsibility to users of our website for performance or nonperformance of such activities. Our website reserves the right to expel users of our website and prevent their further access to our website for violating this agreement or any law or regulation, and also reserves the right to remove communications which are abusive, illegal, or disruptive.

Social Media Warning (Divulgence of Personal &amp; Private Information)
Social media has provided a platform for internet users to disclose much personal information about themselves, in a way that seems innocuous, if not proper and expected. However, more than a few folks have already lived to regret personal information that was shared either by them or others. This has long been true of simple email. It is exponentially true of social websites and applications for social media on any other website, including this one. You are cautioned against carelessly disclosing information.

3. Indemnification.
You agree to indemnify, defend and hold harmless our $name website, its members, officers, directors, employees, agents, licensors, suppliers and any third party information providers to our website from and against all losses, expenses, damages and costs, including reasonable attorneys' fees, resulting from any use of our website or violation of this Agreement (including negligent or wrongful conduct) by you or any other person accessing our website.

4. Third Party Rights.
The provisions of paragraphs 2 (Use of the Service), and 3 (Indemnification) are for the benefit of our website and its owners, officers, directors, employees, agents, licensors, suppliers, and any third party information providers to the Service. Each of these individuals or entities shall have the right to assert and enforce those provisions directly against you on its/their own behalf.

5.Term; Termination.
We reserve the right to investigate complaints or reported violations of these Terms of Service and Conditions of Use and to take any action we deem appropriate, including but not limited to reporting any suspected unlawful activity to law enforcement officials, regulators, or other third parties and disclosing any data necessary or appropriate to such persons or entities relating to your profile, email addresses, usage history, IP addresses and traffic data.

This Agreement, in whole or in part, may be terminated by $name without notice at any time for any reason. The provisions of paragraphs 1 (Copyright, Licenses and Idea Submissions), 2 (Use of the Service), 3 (Indemnification), 4 (Third Party Rights), 6 (Hiring an Attorney / No Attorney-Client Relationship), and 7 (Miscellaneous) shall survive any termination of this Agreement, in whole or in part.

6.Hiring an Investment Advisor, Attorney, or Medical or Other Professional / No Attorney-Client Relationship or Fiduciary Capacity.
Choosing a lawyer, doctor, or investment advisor is a serious matter and should NOT be based solely on data contained on our website or in advertisements.

The law is constantly changing and the data may not be complete or accurate depending on your particular legal issue. Each legal issue depends on its individual facts and different jurisdictions have different laws and regulations. This is why you should seriously consider hiring licensed, professional counsel in your jurisdiction.

Medical issues are complex, and can often stem from both organic and psychological factors. Never should a website be used as a source of diagnosing or treating medical problems.

Financial matters are highly individualistic. Risk tolerance is just one factor to consider before making any investments or financial decisions. For these, and other, reasons, you should look to the guidance of a trained professional, not a website.

You may send us email, but in no instance will this communication in any way be construed as initiating an attorney-client relationship, or other professional relationship, and so the contact should not include confidential or sensitive data because your communication will not be treated as privileged or confidential.

7.Miscellaneous.

Governing Law
This Agreement shall treated as though executed, set in force, and performed in the State of YOURSTATE. Accordingly, it shall be governed and construed in accordance with the laws of YOURSTATE in terms of those applicable to agreements, without regard to conflict of law principles.

Disputes
Any cause of action by you with respect to our $url website must be instituted within one (1) year after the cause of action arose or be forever waived and barred. All actions shall be subject to the limitations set forth in these Terms of Service and Conditions of Use. Any legal claim arising out of or relating to these Terms of Service and Conditions of Use or our website, excluding intellectual property right infringement and other claims by us, shall be settled confidentially through mandatory binding arbitration per the American Arbitration Association commercial arbitration rules. The arbitration shall be conducted in YOURSTATE. Each party shall bear one half of the arbitration fees and costs incurred, and each party shall bear its own lawyer fees. All claims shall be arbitrated on an individual basis, and shall not be consolidated in any arbitration with any claim or controversy of any other party.

Modification
Neither the course of conduct between the parties nor industry trade practice shall act to modify any provision of this Agreement.

Assignability
Our website may assign its rights and duties under this Agreement to any party at any time without notice to you.

Contra Preferentum
The language in these Terms of Service and Conditions of Use shall be interpreted as to its fair meaning and not strictly for or against any party. Any rule of construction to the effect that ambiguities are to be resolved against the drafting party (i.e. – “contra preferentum”) shall not apply in interpreting these Terms of Service and Conditions of Use, as the Agreement shall be construed as having been co-authored by the parties.

Severability
Should any part of these Terms of Service and Conditions of Use be held invalid or unenforceable, that portion shall be construed as much as possible consistent with applicable law and severability shall apply to the remaining portions, so that they remain in full force and effect.

This Agreement Prevails
To the extent that anything in or associated with our website is in conflict or inconsistent with these Terms of Service and Conditions of Use, these Terms of Service and Conditions of Use shall take precedence.

Waiver
Our failure to enforce any provision of these Terms of Service and Conditions of Use shall not be deemed a waiver of the provision nor of the right to enforce the provision.

Our rights under these Terms of Service and Conditions of Use shall survive any termination of this agreement.

Any rights not expressly granted herein are reserved to $name.

&nbsp;

CHANGE NOTICE: As with any of our administrative and legal notice pages, the contents of this page can and will change over time. Accordingly, this page could read differently as of your very next visit. These changes are necessitated, and carried out by $name, in order to protect you and our $url website. If this page is important to you, you should check back frequently as no other notice of changed content will be provided either before or after the change takes effect.

COPYRIGHT WARNING: The legal notices and administrative pages on this website, including this one, have been diligently drafted by an attorney. We at $name have paid to license the use of these legal notices and administrative pages on $url for your protection and ours. This material may not be used in any way for any reason and unauthorized use is policed via Copyscape to detect violators.

QUESTIONS/COMMENTS/CONCERNS: If you have any questions about the contents of this page, or simply wish to reach us for any other reason, you may do so by using our Contact information.

$info";

}
    ?>
        <p>
            <legend><strong>Company Info</strong></legend>
        </p>
        <div class="control-group">
            <label class="control-label" for="name">Company Name</label>
            <div class="controls">
                <input type="text" id="name" name="name" value="<?php echo $name;?>" placeholder="Type your company name">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="url">Company Site URL</label>
            <div class="controls">
                <input type="text" id="url" name="url" value="<?php echo $url;?>" placeholder="Type your site company URL">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="info">Company Info</label>
            <div class="controls">
                <textarea id="info" name="info" class="span12" rows="8" cols="15" placeholder="Type your company Info"><?php echo $info;?></textarea>
            </div>
        </div>

        <hr class="div" />

        <p>
            <legend><strong>Result</strong></legend>
        </p>
        <div class="control-group">
            <label class="control-label" for="asp">Anti-Spam Policy</label>
            <div class="controls">
                <textarea id="asp" name="asp" class="span12" rows="10" cols="15"><?php echo $asp;?></textarea>
            </div>
        </div>  
        <div class="control-group">
            <label class="control-label" for="cn">Copyright Notice</label>
            <div class="controls">
                <textarea id="cn" name="cn" class="span12" rows="10" cols="15"><?php echo $cn;?></textarea>
            </div>
        </div>  
        <div class="control-group">
            <label class="control-label" for="disclaimer">Disclaimer</label>
            <div class="controls">
                <textarea id="disclaimer" name="disclaimer" class="span12" rows="10" cols="15"><?php echo $disclaimer;?></textarea>
            </div>
        </div>  
        <div class="control-group">
            <label class="control-label" for="dmca">DMCA Compliance</label>
            <div class="controls">
                <textarea id="dmca" name="dmca" class="span12" rows="10" cols="15"><?php echo $dmca;?></textarea>
            </div>
        </div>  
        <div class="control-group">
            <label class="control-label" for="federal">Federal Trade Commission Compliance</label>
            <div class="controls">
                <textarea id="federal" name="federal" class="span12" rows="10" cols="15"><?php echo $federal;?></textarea>
            </div>
        </div>  
        <div class="control-group">
            <label class="control-label" for="privacy">Privacy Policy</label>
            <div class="controls">
                <textarea id="privacy" name="privacy" class="span12" rows="10" cols="15"><?php echo $privacy;?></textarea>
            </div>
        </div>  
        <div class="control-group">
            <label class="control-label" for="social">Social Media Disclosure</label>
            <div class="controls">
                <textarea id="social" name="social" class="span12" rows="10" cols="15"><?php echo $social;?></textarea>
            </div>
        </div>  
        <div class="control-group">
            <label class="control-label" for="terms">Terms Of Service &amp; Conditions Of Use</label>
            <div class="controls">
                <textarea id="terms" name="terms" class="span12" rows="10" cols="15"><?php echo $terms;?></textarea>
            </div>
        </div>
        <style type="text/css">
            .main-postbox{
                width: 98%;
            }

            .side-postbox{
                display: none;
            }

            .calibrefx-metaboxes span {
                display: inline;
            }

            .control-group{
                margin-bottom: 12px;
            }
        </style>
    <?php
    }

    

}