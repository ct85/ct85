<?php

// メール情報
// メールホスト名・gmailでは smtp.gmail.com
define('MAIL_HOST','smtp.gmail.com');

// メールユーザー名・アカウント名・メールアドレスを@込でフル記述
//gmailの設定で,アカウントの設定>セキュリティ>安全性の低いアプリのアクセス,をONにする
define('MAIL_USERNAME','*****@gmail.com');

// メールパスワード・上で記述したメールアドレスに即したパスワード
define('MAIL_PASSWORD','*****');

// SMTPプロトコル(sslまたはtls)
define('MAIL_ENCRPT','tls');

// 送信ポート(ssl:465, tls:587)
define('SMTP_PORT', 587);

// メールアドレス・ここではメールユーザー名と同じでOK
define('MAIL_FROM','*****@gmail.com');

// 表示名
define('MAIL_FROM_NAME','出欠太郎');

// メールタイトル
define('MAIL_SUBJECT','仮登録ありがとうございます。');

