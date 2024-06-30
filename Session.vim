let SessionLoad = 1
let s:so_save = &g:so | let s:siso_save = &g:siso | setg so=0 siso=0 | setl so=-1 siso=-1
let v:this_session=expand("<sfile>:p")
silent only
silent tabonly
cd ~/Projects/info-lab
if expand('%') == '' && !&modified && line('$') <= 1 && getline(1) == ''
  let s:wipebuf = bufnr('%')
endif
let s:shortmess_save = &shortmess
if &shortmess =~ 'A'
  set shortmess=aoOA
else
  set shortmess=aoO
endif
badd +8 ~/Projects/info-lab/config/twill.php
badd +15 ~/Projects/info-lab/config/translatable.php
badd +35 ~/Projects/info-lab/config/app.php
badd +8 ~/Projects/info-lab/.env
badd +21 ~/Projects/info-lab/app/Providers/AppServiceProvider.php
badd +34 ~/Projects/info-lab/composer.json
badd +1 ~/Projects/info-lab/app/Repositories/PageRepository.php
badd +25 ~/Projects/info-lab/app/Http/Controllers/Twill/PageController.php
badd +5 ~/Projects/info-lab/routes/twill.php
badd +1 ~/Projects/info-lab/app/Http/Requests/Twill/PageRequest.php
badd +19 ~/Projects/info-lab/app/Models/Page.php
badd +1 ~/Projects/info-lab/app/Models/Slugs/PageSlug.php
badd +7 ~/Projects/info-lab/resources/views/site/page.blade.php
badd +1 ~/Projects/info-lab/resources/views/site/layouts/block.blade.php
badd +6 ~/Projects/info-lab/resources/views/twill/blocks/text.blade.php
badd +1 ~/Projects/info-lab/resources/views/site/blocks/text.blade.php
badd +3 ~/Projects/info-lab/resources/views/site/blocks/image.blade.php
badd +7 ~/Projects/info-lab/resources/views/twill/blocks/image.blade.php
badd +31 ~/Projects/info-lab/docker-compose.yml
badd +9 ~/Projects/info-lab/app/Http/Controllers/PageDisplayController.php
badd +10 ~/Projects/info-lab/routes/web.php
badd +0 ~/Projects/info-lab/resources/views/normal-algo.blade.php
badd +18 ~/Projects/info-lab/database/migrations/2024_06_30_132725_create_menu_links_tables.php
badd +13 ~/Projects/info-lab/app/Models/MenuLink.php
badd +19 ~/Projects/info-lab/app/Http/Controllers/Twill/MenuLinkController.php
badd +12 ~/Projects/info-lab/app/Repositories/MenuLinkRepository.php
badd +12 ~/Projects/info-lab/app/View/Components/Menu.php
badd +35 ~/Projects/info-lab/resources/views/components/menu.blade.php
badd +7 ~/Projects/info-lab/resources/views/components/nav/header.blade.php
badd +5 ~/Projects/info-lab/resources/views/twill/settings/homepage/homepage.blade.php
badd +11 ~/Projects/info-lab/vendor/area17/twill/src/Facades/TwillAppSettings.php
badd +55 ~/Projects/info-lab/vendor/area17/twill/src/TwillAppSettings.php
badd +28 ~/Projects/info-lab/resources/views/components/main-layout.blade.php
badd +0 ~/Projects/info-lab/app/Http/Controllers/BaseConvert.php
badd +0 ~/Projects/info-lab/app/Http/Controllers/Controller.php
argglobal
%argdel
edit ~/Projects/info-lab/resources/views/components/menu.blade.php
let s:save_splitbelow = &splitbelow
let s:save_splitright = &splitright
set splitbelow splitright
wincmd _ | wincmd |
vsplit
1wincmd h
wincmd w
let &splitbelow = s:save_splitbelow
let &splitright = s:save_splitright
wincmd t
let s:save_winminheight = &winminheight
let s:save_winminwidth = &winminwidth
set winminheight=0
set winheight=1
set winminwidth=0
set winwidth=1
exe 'vert 1resize ' . ((&columns * 41 + 79) / 158)
exe 'vert 2resize ' . ((&columns * 116 + 79) / 158)
argglobal
enew
file neo-tree\ filesystem\ \[1]
setlocal fdm=manual
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=99
setlocal fml=1
setlocal fdn=20
setlocal fen
wincmd w
argglobal
balt ~/Projects/info-lab/resources/views/twill/settings/homepage/homepage.blade.php
setlocal fdm=manual
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=99
setlocal fml=1
setlocal fdn=20
setlocal fen
silent! normal! zE
3,5fold
9,12fold
8,13fold
28,30fold
27,31fold
16,33fold
34,36fold
1,38fold
let &fdl = &fdl
let s:l = 6 - ((5 * winheight(0) + 18) / 36)
if s:l < 1 | let s:l = 1 | endif
keepjumps exe s:l
normal! zt
keepjumps 6
normal! 016|
wincmd w
2wincmd w
exe 'vert 1resize ' . ((&columns * 41 + 79) / 158)
exe 'vert 2resize ' . ((&columns * 116 + 79) / 158)
tabnext 1
if exists('s:wipebuf') && len(win_findbuf(s:wipebuf)) == 0 && getbufvar(s:wipebuf, '&buftype') isnot# 'terminal'
  silent exe 'bwipe ' . s:wipebuf
endif
unlet! s:wipebuf
set winheight=1 winwidth=20
let &shortmess = s:shortmess_save
let &winminheight = s:save_winminheight
let &winminwidth = s:save_winminwidth
let s:sx = expand("<sfile>:p:r")."x.vim"
if filereadable(s:sx)
  exe "source " . fnameescape(s:sx)
endif
let &g:so = s:so_save | let &g:siso = s:siso_save
set hlsearch
nohlsearch
doautoall SessionLoadPost
unlet SessionLoad
" vim: set ft=vim :
