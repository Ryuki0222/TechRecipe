<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Work;
use App\Models\Flow;
use App\Models\Tag;
use App\Models\Skill;
use App\Models\Reference;
use App\Models\User;


class NewController extends Controller
{
    public function form()
    {
        return view('new');
    }

    public function add(Request $request)
    {
        $input = $request->all();

        // データベースに存在するユーザかチェックし、存在しなかったら追加
        $work_data = $this->addWorkData($input);
        $work_id = $work_data->id;

        // スキルデータを追加
        $this->addSkillData($input, $work_id);

        // 制作フローデータ(参照データも)を追加
        $this->addFlowData($input, $work_id);

        // 作成した記事を表示する
        $hash = $work_data->hash;
        $recipe = $this->getRecipe($hash);
        return view('add', $recipe);
    }

    /**
     * 重複チェックして作品データを追加
     * @param input POSTデータ
     * @return work_data 追加対象の作品データ
     */
    private function addWorkData($input)
    {
        // 投稿する作品のハッシュを生成
        $hash = $this->createHash(6);

        // 画像保存
        $work_img = $input['work_img'];
        $work_img_path = $work_img->hashName();
        $image = \Image::make(file_get_contents($work_img->getRealPath()));
        $image->save(public_path().'/img/'.$work_img_path);

        $work_data = Work::firstOrCreate([
            'work_name' => $input['work_name'],
            'user_id' => $input['github_id']
        ],[
            'hash' => $hash,
            'work_name' => $input['work_name'],
            'work_description' => $input['work_description'],
            'work_img_path' => $work_img_path,
            'user_id' => $input['github_id'],
            'github_url' => $input['github_url'],
        ]);
        return $work_data;
    }

    /**
     * スキルリストを分割して、skillsに追加
     * @param input POSTデータ
     */
    private function addSkillData($input, $work_id)
    {
        $skills = explode(' ', $input['skills']);
        foreach ($skills as $skill) {
            if ($skill !== '') {
                // tagsに存在するデータかチェックし、なかったら追加
                $tag_data = Tag::firstOrCreate([
                    'tag_name' => $skill
                ],[
                    'tag_name' => $skill
                ]);
                $tag_id = $tag_data->id;

                // skillsにinsert
                $skill_data = Skill::firstOrCreate([
                    'tag_id' => $tag_id,
                    'work_id' => $work_id
                ],[
                    'tag_id' => $tag_id,
                    'work_id' => $work_id
                ]);
            }
        }
    }

    /**
     * 制作フローデータの追加
     * @param input POSTデータ
     */
    private function addFlowData($input, $work_id)
    {
        $flow_images = $input['flow_img'];
        $flow_descriptions = $input['flow_description'];
        $flow_references = $input['flow_reference'];
        for ($i = 0; $i < count($flow_images); $i++) {
            $flow_image = $flow_images[$i];
            $flow_description = $flow_descriptions[$i];
            $flow_reference = nl2br($flow_references[$i]);

            // 画像保存
            $flow_image_path = $flow_image->hashName();
            $image = \Image::make(file_get_contents($flow_image->getRealPath()));
            $image->save(public_path().'/img/'.$flow_image_path);

            if ($flow_description !== '') {
                // flowsに追加
                $flow_no = $i+1;
                $flow_data = Flow::firstOrCreate([
                    'work_id' => $work_id,
                    'flow_no' => $flow_no
                ],[
                    'work_id' => $work_id,
                    'flow_description' => $flow_description,
                    'flow_img_path' => $flow_image_path,
                    'flow_no' => $flow_no
                ]);
                $flow_id = $flow_data->id;

                // referencesに追加
                $references = explode('<br />', $flow_reference);
                foreach ($references as $reference) {
                    $reference = str_replace('<br />', '', $reference);
                    if ($reference !== '') {
                        $reference_data = Reference::firstOrCreate([
                            'flow_id' => $flow_id,
                            'ref_url' => $reference
                        ],[
                            'flow_id' => $flow_id,
                            'ref_name' => $this->getPageTitle($reference),
                            'ref_url' => $reference,
                        ]);
                    }
                }
            }
        }
    }

    /**
     *  ハッシュを作成する
     * @param length ハッシュの長さ
     * @return r_str ハッシュ
     */
    private function createHash($length)
    {
        $str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
        $r_str = '';
        for ($i = 0; $i < $length; $i++) {
            $r_str .= $str[rand(0, count($str) - 1)];
        }
        return $r_str;
    }

    /**
     * 参照URLのタイトルを取得
     * @param url 参照URL
     * @return title ページタイトル
     */
    private function getPageTitle($url) {
        $source = @file_get_contents($url);
        //文字コードをUTF-8に変換し、正規表現でタイトルを抽出
        if (preg_match('/<title>(.*?)<\/title>/i', mb_convert_encoding($source, 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS'), $result)) {
            $title = $result[1];
        } else {
            //TITLEタグが存在しない場合
            $title = $url;
        }
        return $title;
    }

    private function getRecipe($hash)
    {
        $work = Work::where('hash', $hash)->first();
        $work_id = $work->id;
        $flows = Flow::where('work_id', $work_id)->get();
        //タグを取得する
        $skills = Skill::where('work_id', $work_id)->get();
        $tags = array();
        foreach($skills as $skill){
            $tag = Tag::where('id', $skill->tag_id)->first();
            $tags[] = $tag;
        }
        //ユーザー情報を取得
        $user_id = $work->user_id;
        $user = User::where('github_id', $user_id)->first();

        return ["flows" => $flows, "numberofflow" => count($flows), "work" => $work, "tags" => $tags, "user" => $user];
    }
}