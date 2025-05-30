@echo off

echo Configurando Git...
set PATH=%PATH%;C:\Program Files\Git\bin

:: Configurar nome e email do GitHub
git config --global user.name "railsonsantos2005"
git config --global user.email "seu_email@gmail.com"

:: Inicializar repositório
echo Inicializando repositório Git...
git init
git add .
git commit -m "Primeiro commit"

:: Criar repositório no GitHub
echo Criando repositório no GitHub...
set /p repo_name="Digite o nome do repositório (por exemplo: quadra-reservas): "

:: Adicionar repositório remoto
git remote add origin https://github.com/railsonsantos2005/%repo_name%.git

:: Fazer push para o GitHub
echo Fazendo push para o GitHub...
git push -u origin master

echo Upload concluído!
pause
