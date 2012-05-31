// ----------------------------------------------------------------------------
// markItUp!
// ----------------------------------------------------------------------------
// Copyright (C) 2008 Jay Salvat
// http://markitup.jaysalvat.com/
// ----------------------------------------------------------------------------
// BBCode tags example
// http://en.wikipedia.org/wiki/Bbcode
// ----------------------------------------------------------------------------
// Feel free to add more tags
// ----------------------------------------------------------------------------
mySettings = {
	previewParserPath:	'', // path to your BBCode parser
	markupSet: [
		{name:'Bold', key:'B', openWith:'[b]', closeWith:'[/b]'},
		{name:'Italic', key:'I', openWith:'[i]', closeWith:'[/i]'},
		{name:'Underline', key:'U', openWith:'[u]', closeWith:'[/u]'},
				{	name:'Colors', 
			className:'colors', 
			openWith:'[color=[![Color]!]]', 
			closeWith:'[/color]', 
				dropMenu: [
					{name:'Yellow',	openWith:'[color=yellow]', 	closeWith:'[/color]', className:"col1-1" },
					{name:'Orange',	openWith:'[color=orange]', 	closeWith:'[/color]', className:"col1-2" },
					{name:'Red', 	openWith:'[color=red]', 	closeWith:'[/color]', className:"col1-3" },
					
					{name:'Blue', 	openWith:'[color=blue]', 	closeWith:'[/color]', className:"col2-1" },
					{name:'Purple', openWith:'[color=purple]', 	closeWith:'[/color]', className:"col2-2" },
					{name:'Green', 	openWith:'[color=green]', 	closeWith:'[/color]', className:"col2-3" },
					
					{name:'White', 	openWith:'[color=white]', 	closeWith:'[/color]', className:"col3-1" },
					{name:'Gray', 	openWith:'[color=gray]', 	closeWith:'[/color]', className:"col3-2" },
					{name:'Black',	openWith:'[color=black]', 	closeWith:'[/color]', className:"col3-3" }
				]
		},
		{separator:'---------------' },
		{name:'Picture', key:'P', replaceWith:'[img][![Url]!][/img]'},
		{name:'Link', key:'L', openWith:'[url=[![Url]!]]', closeWith:'[/url]', placeHolder:'Your text to link here...'},
		{separator:'---------------' },
		{name:'Size', key:'S', openWith:'[size=[![Taille du texte (0-200)]!]]', closeWith:'[/size]',
		dropMenu :[
			{name:'Big', openWith:'[size=200]', closeWith:'[/size]' },
			{name:'Normal', openWith:'[size=100]', closeWith:'[/size]' },
			{name:'Small', openWith:'[size=50]', closeWith:'[/size]' }
		]},
		{separator:'---------------' },
		{name:'Align',
		dropMenu :[
			{name:'Gauche', openWith:'[gauche]', closeWith:'[/gauche]', className:"left" },
			{name:'Centre', openWith:'[centre]', closeWith:'[/centre]', className:"center" },
			{name:'Droite', openWith:'[droite]', closeWith:'[/droite]', className:"right" }
		]},
		{separator:'---------------' },
		{name:'Bulleted list', openWith:'[list]\n', closeWith:'\n[/list]'},
		{name:'Numeric list', openWith:'[list=[![Starting number]!]]\n', closeWith:'\n[/list]'}, 
		{name:'List item', openWith:'[*] '},
		{separator:'---------------' },
		{name:'Quotes', openWith:'[quote]', closeWith:'[/quote]'},
		{name:'Code', openWith:'[code]', closeWith:'[/code]'}, 
		{name:'Html', openWith:'[html]', closeWith:'[/html]'}, 
		{separator:'---------------' },
		{name:'Clean', className:"clean", replaceWith:function(markitup) { return markitup.selection.replace(/\[(.*?)\]/g, "") } },
		{name:'Clean', className:"uploader", replaceWith:function(markitup) {window.open("http://www.vupload.tonsite.biz/?small","nom_popup","menubar=no, status=no, scrollbars=no, menubar=no, width=500, height=400");} }
	]
}