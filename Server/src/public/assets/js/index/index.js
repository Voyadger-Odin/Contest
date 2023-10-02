// jquery & prism js

let code =
    `# Python
a, b = map(int, input().split())
print(a + b)`;

code = code.split('');

let index = 0;


var interval = setInterval(()=> {
    if (!(index < code.length)) clearInterval(interval);

    $('code').append(code[index]);

    Prism.highlightElement($('.js-code')[0]);

    index++;
}, 40);


$(document).ready(function () {
    // MarkDown
    MathJax.typeset()
});
