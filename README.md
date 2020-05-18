# trapo_tri_test
Test done for the position of php developer at trapo tri : Create a To-Do project

<h1>Sobre as decisões de design:</h1>

<h5>Por que a não utilização de framework?</h5>
<p>Pela minha não familiarização com frameworks e pela menor complexidade do projeto decidi não utilizar nenhum framework ou package da linguagem</p>

<h5>Por que a não utilização de ORM?</h5>
<p>Pelo fato do banco só ter apenas 3 tabelas não considerei necessario utilizar um quando uma classe de gerencimento utilizando OOP resolveria</p>

<h5>Por que a utilização de Mysqli e não PDO?</h5>
<p>PDO é a recomendação porém devido ao fato de estar especificado que o banco seria mysql e pelo fato da minha classe de controle de banco de dados ser de mysqli optei por usar o mesmo</p>

<h5>Por que a não utilização de Bootstrap ou template?</h5>
<p>Pelo fato de ter experiencia utilizando materialize css seria mais rapido</p>

<h5>Organização de arquivos?</h5>
<p>Devido ao tempo e no intuito de causar o minimo de efeitos colaterais no servidor optei por utilizar tudo no mesmo folder ou/e utilizar cdn.Normalmente separo arquivos em update e inserts porém tambem devido ao tempo reutilizei alguns scripts</p>

<h5>Nomenclatura</h5>
<p>Arquivos onde de alguma forma o usuario irá interagir diretamente ou classes são nomeados em Pascal Case(cada nome inicia com letra maiuscula),arquivos sem interação direta são camel case(primeira letra minuscula e letras iniciais de outras palavras maiusculas)</p>

