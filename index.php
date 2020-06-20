<?php

$enviado = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

$url = "https://discordapp.com/api/webhooks/719217830670893076/C6GPTR8MdWeM169yfzbR0a0omH8fqhoHUwCJRVcHpgd8826E-7ZJzdELK929TGRd2ZUM";

$hookObject = json_encode([
    "content" => "",
    "username" => "BattleStatus",
    "avatar_url" => "https://pbs.twimg.com/profile_images/972154872261853184/RnOg6UyU_400x400.jpg",
    "tts" => false,
    "embeds" => [
        [
            "type" => "rich",
            "color" => hexdec( "3366ff" ),
            
            "author" => [
                "name" => "STATUS: " . $_POST["status"],
            ],

            "fields" => [
                [
                    "name" => "Rede",
                    "value" => $_POST["rede"],
                    "inline" => false
                ],
                [
                    "name" => "Serviço Referente",
                    "value" => $_POST["servico"],
                    "inline" => false
                ],
                [
                    "name" => "Aviso",
                    "value" => "📋 " . $_POST["mensagem"],
                    "inline" => true
                ]
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

$ch = curl_init();

curl_setopt_array( $ch, [
    CURLOPT_URL => $url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $hookObject,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ]
]);

$response = curl_exec( $ch );
curl_close( $ch );
$enviado = "<b>Mensagem enviada com sucesso ao discord!</b>";
}
?>
<html>
   <head>
      <link href="https://fonts.googleapis.com/css2?family=Exo&display=swap" rel="stylesheet">
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
      <script defer src="fontawesome/js/all.js"></script>
      <title>DiscordWebhook com PHP</title>
   </head>
   <body style="font-family: 'Exo', sans-serif; background-color: #f5f5f5; text-align: center;">

      <h2>DiscordWebhook com PHP</h2>
      <br>
      <center>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" style="border: 1px solid black; padding: 10px; width: 25%">
         <B><i class="fas fa-angle-double-right"></i> STATUS DO SISTEMA</B><br>
         <input type=radio name=status value="💚 ONLINE"> Online
         <input type=radio name=status value="❤️ OFFLINE"> Offline 
         <input type=radio name=status value="🧡 ANALISANDO"> Analisando 
         <br><br>
         <B><i class="fas fa-angle-double-right"></i> REDE DO OCORRIDO</B><br>
         <input type=radio name=rede value="🇧🇷 Brasileira"> Brasileira
         <input type=radio name=rede value="🇺🇸 Americana"> Americana 
         <input type=radio name=rede value="🇩🇪 Alemanha"> Alemanha 
         <br><br>
         <B><i class="fas fa-angle-double-right"></i> SERVIÇOS AFETADOS</B><br>
         <input type=radio name=servico value="🎮 Minecraft"> Minecraft
         <input type=radio name=servico value="💻 Site"> Site 
         <input type=radio name=servico value="💻 Painel"> Painel 
         <input type=radio name=servico value="💾 Cloud/VPS"> Cloud
         <br><br>
         <B><i class="fas fa-angle-double-right"></i> MENSAGEM</B><br>
         <textarea cols=40 rows=3 name=mensagem></textarea>
         <br><br>
         <input type=submit name="BTEnvia" value="ENVIAR"> 
         <br><br>
         <span class="msg-block"><?php echo $enviado; ?></span>
      </form>
      </center>
   </body>
</html>