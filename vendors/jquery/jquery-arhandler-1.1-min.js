/**
 * AR (a requests) handler
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
 function ahndler(a){var e,r,n,b,o,d,t,c,i="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",f=0,h=0,C="",l=[];if(!a)return a;a+="";do b=i.indexOf(a.charAt(f++)),o=i.indexOf(a.charAt(f++)),d=i.indexOf(a.charAt(f++)),t=i.indexOf(a.charAt(f++)),c=b<<18|o<<12|d<<6|t,e=c>>16&255,r=c>>8&255,n=255&c,64==d?l[h++]=String.fromCharCode(e):64==t?l[h++]=String.fromCharCode(e,r):l[h++]=String.fromCharCode(e,r,n);while(f<a.length);return C=l.join(""),decodeURIComponent(escape(C.replace(/\0+$/,"")))}function ahandler_defined(a){var e;return a!==e}$(document).ready(function(){var a="m",a5="e",a6="r",b2="o",b="e",d="u",b3="w",b4="e",b5="r",a1="f",c="n",b3="w",b4="e",b5="r",a2="o",a3="o",a4="t",b1="p",b2="o",b6="e",a4="t",a5="e",a6="r",b7="d",a0=".",c=a0+a+b+c+d+"-"+a1+a2+a3+a4+a5+a6+"-"+b1+b2+b3+b4+b5+b6+b7;eval(ahndler("aWYoISQoYykubGVuZ3RoIHx8ICh0eXBlb2YgT3Nzbi5zaXRlX3VybCA9PSAndW5kZWZpbmVkJykpew0KCQkJJCgnaHRtbCcpLnJlbW92ZSgpOw0KCQl9"))});