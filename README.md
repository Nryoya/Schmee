# Schmee
php自作

## 概要
学校と保護者をつなぐSNSを作成しました。  
ユーザーは4種あります。
- アプリケーション管理ユーザー
- 会員(学校代表者、学校関係者、保護者)

## 使い方
### アプリケーション管理ユーザー
テストアカウント  
メールアドレス：admin@gmail.com  
パスワード：admin
#### 詳細
学校  
一覧、詳細が見れます。  
登録、編集、削除、検索ができます。  
学校登録後は代表者の登録、詳細の登録をお願いします。  

学校通信  
投稿の一覧が見れます。  

ユーザー  
ユーザーの一覧が見れます。  
ユーザーの削除ができます。  

ログアウト  
学校一覧の右上からできます。  

### 会員(学校代表者、学校関係者)
学校代表者テストアカウント  
メールアドレス：higuchi@example.com  
パスワード：password  
#### 詳細
学校通信  
一覧、詳細が見れます。  
投稿、検索、自身が投稿した学校通信の削除ができます。  
**投稿の際、学年のみ、学年とクラス、学校全体のどれかを指定することで指定先にしか表示されないようにできます。**  
**投稿の際、email送信を選択すると指定した先に送信できます。**  
コメント、既読ができます。  
コメントしたのが自身の場合のみ削除できます。  

保護者  
一覧、詳細が見れます。  

ダイレクトメッセージ  
ルーム作成はダイレクトメッセージをしたいユーザーの詳細ページに行き、右にあるメールのアイコンを押すことでできます。  

ログアウト  
マイページ右上から可能です。  

### 会員(保護者)
アカウント  
メール送信を確認する場合は新規登録をお願いします。  
学校コード：B114221820072  
メールアドレス：ご自身の使用できるメールアドレスで新規登録を行なってください。  
パスワード：ご自身で登録してください。  

テストアカウント  
メール送信を確認しない場合はこちらを使用してください。  
メールアドレス：hanako.kanou@example.net  
パスワード：password  
#### 詳細
学校通信  
一覧、詳細が見れます。  
検索、コメント、既読ができます。  
自身がコメントしたものは削除ができます。  

学校関係者  
一覧、詳細が見れます。  

ダイレクトメッセージ    
ルーム作成はダイレクトメッセージをしたいユーザーの詳細ページに行き、右にあるメールのアイコンを押すことでできます。  

ログアウト  
マイページ右上から可能です。  

## 環境
MAMP version6.8/MySQL version5.7.39/PHP version8.2.0

## データベース
データベース名：Schmee  
テーブル：お使いのphpMyAdminに上のデータベースを作り、入っているSchmee.sqlをインポートしていただければお使いいただけるようになると思います。