Testes de Unidade
=================
Este projeto foi criado com o intuito de exemplificar testes de unidade em um treinamento do [Synergia](http://synergia.dcc.ufmg.br).
Ele implementará uma calculadora utilizando TDD.
Testes de integração/funcionais não fazem parte do escopo deste projeto.

Dependências
------------
Este projeto foi criado execução no netbeans em windows. Sendo necessária a instalação e configuração de algumas dependências para sua execução completa.

Os softwares necessários são os seguintes:
1. Cliente git: https://msysgit.github.io/
2. Xampp: https://www.apachefriends.org/ (s eo xampp for instalado via zip, é necessário editar todos os arquivos .bat da pasta php e o php.ini modificando o diretorio **/xampp** para o diretório onde o xampp foi descompactado (ex: M:\xampp).
3. Composer: obtenha o composer.phar em https://getcomposer.org/ e coloque no diretório do php do xampp.
4. Netbeans com suporte a php e html5: http://www.netbeans.org/download.
Existe obter a versão zip se não tiver permissão de instalação, basta depois instalar os plugins necessários para php/html5
5. Node.js: http://nodejs.org/ (caso não possua permissão de administrador, siga os passos de [NODE_PORTATIL.md](NODE_PORTATIL.md)
6. Karma:  `npm install -g karma`
7. Karma-cli:  `npm install -g karma-cli`
8. Jasmine: `npm install -g jasmine`
9. Karma-jasmine:  `npm install -g karma-jasmine`
10. Karma-chrome-launcher: `npm install -g karma-chrome-launcher`
11. Karma-firefox-launcher: `npm install -g karma-firefox-launcher`

Configuração
-----------------------

### Netbeans ###
1. Acesse o menu **Tools > Options**
2. **PHP > General**
4. Coloque o caminho do php.exe do xampp em PHP5 interpreter
5. **PHP > Frameworks & Tools**
6. Selecione **Composer** na lista da esquerda
7. Coloque o caminho do arquivo composer.phar que está no diretório php do xampp


### Obtendo o projeto ###
1. Acesse o menu **Team > Remote... > Clone**
2. Em *Repository URL* preencha  https://github.com/massahud/zf2-testeunidade.git`
3. **Next**
4. **Next**
5. Coloque o diretório pai em **Parent directory**, por exemplo `M:\`
6. **Finish**
7. Após o download no popup exibido clique em **Open project**
8. Clique com o botão direito no projeto aberto
9. Selecione **Composer > Install (Dev)**
10. Espere o composer terminar o download das bibliotecas php utilizadas no projeto


### Obtendo as dependências php ###
Dentro de zf2-testeunidade, execute o composer:
```bat
composer.bat self-update
composer.bat install
```
O composer irá fazer download das bibliotecas php utilizadas no projeto

### Apache ###
Configure o diretório da aplicação no apache editando o arquivo httpd.conf da seguinte forma:
1. Adicione o diretório zf2-testeunidade
```xml
<Directory "m:/zf2-testeunidade">
    Options Indexes FollowSymLinks Includes ExecCGI
    AllowOverride All
    Require all granted
</Directory>
```
2. Adicione o alias /tu para o diretório dentro do bloco **IfModule alias_module**
```xml
<IfModule alias_module>
    Alias /tu m:/zf2-testeunidade/public
    [...]
</IfModule>
```
3. Inicie o apache e acesse http://localhost/tu para verificar se a aplicação está funcionando corretamente

### Configurando os testes javascript no netbeans ###
1. Clique com o botão direito no projeto
2. Selecione **Properties**
3. Selecione **Javascript Testing** na árvore da esquerda
4. Selecione **Karma** em *Testing provider*
5. Preencha o campo *Karma* com o caminho para o arquivo karma.cmd de seu node.js
6. Preencha o campo *Configuration* com o caminho do arquivo **js-test/karma.conf.js** do projeto
7. Marque os dois checkboxes da tela
8. **Ok**
9. No final da árvore do projeto deve aparecer uma entrada chamada **Karma**
10. Clique com o botão direito em **Karma** e escolha **Start**
11. Se tudo der certo, os testes serão executados
12. Se aparecer uma mensagem de erro informando que um administrador instalou o chrome no sistema, significa que você possui um chrome local além do instalado pelo administrador, e o karma está abrindo primeiro o chrome local. Para resolver isso, siga os seguintes passos:
  1. Abra o arquivo ***node_modules\karma-chrome-launcher*** que está dentro do diretório de instalaçãod o node.js.
  2. Procure pela linha `var prefixes = [process.env.LOCALAPPDATA, process.env.PROGRAMFILES, process.env['PROGRAMFILES(X86)']];`
  3. Coloque o primeiro item no final da seguinte forma:
  `var prefixes = [process.env.PROGRAMFILES, process.env['PROGRAMFILES(X86)'], process.env.LOCALAPPDATA];`
  4. Salve o arquivo
  5. Clique com o botão direito novamente em **Karma** no netbeans e escolha **Restart**
  6. Dessa vez os testes devem executar


