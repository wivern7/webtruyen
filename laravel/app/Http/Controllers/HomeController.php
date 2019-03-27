<?php

namespace App\Http\Controllers;

use Email;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Option;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function tos()
    {
        return view('tos');
    }

    public function contact()
    {
        return view('contact');
    }

    public function sitemap()
    {
        $categories = \App\Category::select('alias', 'updated_at')->get();
        $authors     = \App\Author::select('alias', 'updated_at')->get();
        $stories    = \App\Story::select('alias', 'updated_at')->orderBy('created_at', 'DESC')->get();
        $contents = \View::make('sitemap')->with(['categories' => $categories , 'authors' =>$authors, 'stories' =>$stories]);
        $response = \Response::make($contents, 200);
        $response->header('Content-Type', 'application/xml');
        return $response;
    }

    // Gửi thông tin đến Admin
    public function sendContact(Request $request)
    {
        $data = $request->all();
        \Mail::send('email.contact', $data, function($m) use ($data){
            $m->from($data['email'], $data['name']);
            $m->to(\App\Option::getvalue('email_contact'), 'Admin');
            $m->subject($data['subject'] . ' - Từ trang web truyện');
        });
        return 'Email Đã Được Gửi, Cảm ơn bạn !';
    }

    public function install()
    {
        $status = Option::getvalue('installed');
        if(!$status)
        {
            Option::add('sitename', 'TruyenMoi.vn');
            Option::add('fb_app', '# YOUR #');
            Option::add('fb_admin_id', '# YOUR #');
            Option::add('google_veri', '# YOUR #');
            Option::add('google_analytics', '# YOUR #');
            Option::add('has_register', 1);
            Option::add('pageheader', '<!-- Code -->');
            Option::add('pagefooter', '<!-- Code -->');
            Option::add('copyright', 'Copyright &copy; 2016, Dinh Quoc Han.');
            Option::add('description', '');
            Option::add('keyword', '');
            Option::add('tos_content', '<h3>Terms of service - Điều khoản sử dụng</h3>
<p>Tất cả nội dung tr&ecirc;n website ch&uacute;ng t&ocirc;i (Nội Dung) đều được tổng hợp từ c&aacute;c nguồn c&ocirc;ng khai tr&ecirc;n Internet v&agrave; được đọc một c&aacute;ch miễn ph&iacute; bởi c&aacute;c th&agrave;nh vi&ecirc;n. Nếu bạn muốn sử dụng những Nội Dung n&agrave;y, y&ecirc;u cầu ghi r&otilde; nguồn tổng hợp từ ch&uacute;ng t&ocirc;i. Nếu bạn sử dụng với mục đ&iacute;ch kinh doanh, y&ecirc;u cầu t&igrave;m hiểu kỹ về bản quyền nội dung gốc. Việc vi phạm bản quyền sẽ được xử l&yacute; theo quy định.</p>
<p>All the contents on our website (Content) are collected from the public sources on the Intenret and are free to read by all members and visitos. If you want to use the Content, please provide a source link (Collected by) to us in your content. If you want to use the Content for business purposes, please do research about the original copyright of the Content. The copyright violation in any form will be fully responsible.</p>
<h3>Privacy policy - Ch&iacute;nh s&aacute;ch bảo mật</h3>
<p>Cũng như hầu hết c&aacute;c website kh&aacute;c, website Truyện Full ("Truyện Full") thu thập những th&ocirc;ng tin kh&ocirc;ng định danh được c&aacute;c tr&igrave;nh duyệt v&agrave; m&aacute;y chủ cung cấp, như loại tr&igrave;nh duyệt, ng&ocirc;n ngữ, lựa chọn của kh&aacute;ch truy cập tr&ecirc;n Truyện Full v&agrave; thời gian kh&aacute;ch truy cập truy cập v&agrave;o Truyện Full. Thỉnh thoảng Truyện Full sẽ tạo ra c&aacute;c b&aacute;o c&aacute;o c&oacute; chứa th&ocirc;ng tin kh&ocirc;ng định danh của kh&aacute;ch truy cập n&oacute;i chung, v&iacute; dụ như th&aacute;ng n&agrave;y kh&aacute;ch truy cập sử dụng hệ điều h&agrave;nh g&igrave;.</p>
<p>Like most website operators, website Truyện Full ("Truyện Full") collects non-personally-identifying information of the sort that web browsers and servers typically make available, such as the browser type, language preference, referring site, the choice visitor made on Truyện Full and the date and time of each visitor request. From time to time, Truyện Full may release non-personally-identifying information in the aggregate, e.g. by publishing a report on trends in the usage of its website.</p>
<h3>External links - Link ngo&agrave;i</h3>
<p>Mặc d&ugrave; ch&uacute;ng t&ocirc;i lu&ocirc;n muốn sử dụng những link ngo&agrave;i chất lượng, an to&agrave;n v&agrave; ph&ugrave; hợp với điều khoản bảo mật của Truyện Full, bạn n&ecirc;n cẩn thận mỗi khi click một link ra ngo&agrave;i Truyện Full. Ch&uacute;ng t&ocirc;i kh&ocirc;ng thể đảm bảo tất cả những link ngo&agrave;i tr&ecirc;n Truyện Full đều an to&agrave;n d&ugrave; ch&uacute;ng t&ocirc;i lu&ocirc;n cố gắng l&agrave;m điều đ&oacute;.</p>
<p>Although this website only looks to include quality, safe and relevant external links users should always adopt a policy of caution before clicking any external web links mentioned throughout this website. The owners of this website cannot guarantee or verify the contents of any externally linked website despite their best efforts. Users should therefore note they click on external links at their own risk and this website and it\'s owners cannot be held liable for any damages or implications caused by visiting any external links mentioned.</p>
<h3>DMCA Compliance</h3>
<p>Nếu bạn c&oacute; ph&agrave;n n&agrave;n g&igrave; về nội dung hoặc bất cứ vấn đề g&igrave; tại Truyện Full, như vấn đề bản quyền, nội dung kh&ocirc;ng được cho ph&eacute;p, vui l&ograve;ng gửi email đến cho ch&uacute;ng t&ocirc;i tại địa chỉ <a class="text-primary" href="mailto:contact@dinhquochan.com">contact@dinhquochan.com</a>. Nội dung bao gồm chữ v&agrave; h&igrave;nh ảnh được đ&oacute;ng g&oacute;p bởi nhiều th&agrave;nh vi&ecirc;n của Truyện Full. Chủ nh&acirc;n của Truyện Full kh&ocirc;ng chịu tr&aacute;ch nhiệm về bất cứ nội dung n&agrave;o được đăng bởi th&agrave;nh vi&ecirc;n.</p>
<p>We want to ensure that the content that we host can be re-used by other users without fear of liability and that it is not infringing the proprietary rights of others. However, we also recognize that not every takedown notice is valid or in good faith. For more information on what to do if you think a DMCA notice has been improperly filed, you may wish to consult the Chilling Effects website. If you are the owner of content that is being improperly used without your permission, you may request that the content be removed under the DMCA. To make such a request, please contact us via our email address <a class="text-primary" href="mailto:contact@dinhquochan.com">contact@dinhquochan.com</a>. Before filing a DMCA claim, you also have the option of sending a notice via our email address <a class="text-primary" href="mailto:contact@dinhquochan.com">contact@dinhquochan.com</a>. Content including text and images is based on the contribution of each member website. Website owner is not responsible for content posted by members.</p>');
            Option::add('email_contact', 'admin@domain');
            Option::add('fb_fanpage', 'https://www.facebook.com/');
            Option::add('ads_header', '<!-- Code -->');
            Option::add('ads_footer', '<!-- Code -->');
            Option::add('ads_story', '<!-- Code -->');
            Option::add('ads_chapter', '<!-- Code -->');
            Option::add('installed', 1);
            \App\User::create([
                'name' => "Admin",
                'email' => "admin@domain.ltd",
                'password' => bcrypt("123456"),
                'level'     => 2,
            ]);
            return 'This Application had been installed !';
        }
        else
            abort(403);
    }
}
