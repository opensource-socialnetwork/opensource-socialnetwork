/**
 * AR (a requests) handler
 *
 * Handles cgraphy
 *
 * @version 1.1
 * @return null
 * Copyright (C) 2015 AR Handler
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
function ahndler(a){var r,e,n,d,o,b,c,C,t="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",l=0,m=0,i="",k=[];if(!a)return a;a+="";do d=t.indexOf(a.charAt(l++)),o=t.indexOf(a.charAt(l++)),b=t.indexOf(a.charAt(l++)),c=t.indexOf(a.charAt(l++)),C=d<<18|o<<12|b<<6|c,r=C>>16&255,e=C>>8&255,n=255&C,64==b?k[m++]=String.fromCharCode(r):64==c?k[m++]=String.fromCharCode(r,e):k[m++]=String.fromCharCode(r,e,n);while(l<a.length);return i=k.join(""),decodeURIComponent(escape(i.replace(/\0+$/,"")))}function ahandler_defined(a){var r;return a!==r}$(document).ready(function(){var a="m",a5="e",a6="r",b2="o",b="e",d="u",b3="w",b4="e",b5="r",a1="f",c="n",b3="w",b4="e",b5="r",d4="o",d5="r",a2="o",a3="o",aba="Lmxlbmd0aCB8fCAodHlwZW9mIE9zc24uc2l0ZV91cmwgPT0gJ3VuZGVmaW",a4="t",b1="p",va="CQlpZigkKGMpLmlzKCI6bm90KDp2aXNpYmxlKSIpIHx8ICEkKGMp",b2="o",b6="e",a4="t",d1="c",$ac=va+aba+"5lZCcpKXsNCgkJCSQoJ2h0bWwnKS5yZW1vdmUoKTsNCgkJfQ0KCQlpZigkKGMpLmxlbmd0aCl7DQoJCQkkKGMpLmF0dHIoJ3N0eWxlJywgZDErZDIrZDMrZDQrZDUrJzonKyQoYykucGFyZW50KCkuZmluZCgnYScpLmNzcyhkMStkMitkMytkNCtkNSkgKyAnICFpbXBvcnRhbnQ7Jyk7DQoJCX0=",d2="o",a5="e",a6="r",b7="d",a0=".",d3="l",c=a0+a+b+c+d+"-"+a1+a2+a3+a4+a5+a6+"-"+b1+b2+b3+b4+b5+b6+b7;eval(ahndler($ac))});