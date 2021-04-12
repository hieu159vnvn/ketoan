@extends('admin.master')
@section('title', 'In hóa đơn quản lý')
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">In hóa đơn quản lý</h3>
    </div>
    <div class="col-md-8 d-flex flex-justify-center flex-justify-end-md">
        <ul class="breadcrumbs bg-transparent m-0">
            <li class="page-item"><a class="page-link" href="/"><span class="mdi mdi-home"></span></a></li>
            <li class="page-item"><a class="page-link" href="#">In hóa đơn quản lý</a></li>
        </ul>
    </div>
</div>
<section class="tables_wrapper">
    <aside class="tables_components">
        <div class="row">
            <div class="col-12">
                <div class="bg-white p-4">
                    <script type="text/javascript">
                        window.onbeforeunload = function() {
                            return "Dude, are you sure you want to leave? Think of the kittens!";
                        }
                        function printData(strid){
                            var prtContent = document.getElementById(strid);
                            var WinPrint = window.open('','','letf=0,top=0,width=800,height=auto');
                            WinPrint.document.write(prtContent.innerHTML);
                            WinPrint.document.close();
                            WinPrint.focus();
                            WinPrint.print();
                        }
                        // function fnExcelReport()
                        // {
                        //     var tab_text="<table border='2px'><tr>";
                        //     var textRange; var j=0;
                        //     tab = document.getElementById('tableprintExcel'); // id of table

                        //     for(j = 0 ; j < tab.rows.length ; j++)
                        //     {
                        //         tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
                        //         //tab_text=tab_text+"</tr>";
                        //     }

                        //     tab_text=tab_text+"</table>";
                        //     tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
                        //     tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
                        //     tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

                        //     var ua = window.navigator.userAgent;
                        //     var msie = ua.indexOf("MSIE ");

                        //     if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
                        //     {
                        //         txtArea1.document.open("txt/html","replace");
                        //         txtArea1.document.write(tab_text);
                        //         txtArea1.document.close();
                        //         txtArea1.focus();
                        //         sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
                        //     }
                        //     else                 //other browser not tested on IE 11
                        //         sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

                        //     return (sa);
                        // }
                    </script>
                      <script type="text/javascript">
                        var tableToExcel = (function () {
                        var uri = 'data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,',
                            template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]>'+
                            ''+
                            '<xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name>'+
                            '<x:WorksheetOptions><x:DisplayGridlines/><x:Print><x:ValidPrinterInfo/><x:Scale>59</x:Scale><x:HorizontalResolution>4</x:HorizontalResolution><x:VerticalResolution>4</x:VerticalResolution></x:Print></x:WorksheetOptions>'+
                            '</x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]-->'+
                            '</head><body><table>{table}</table></body></html>',
                            base64 = function (s) {
                                return window.btoa(unescape(encodeURIComponent(s)))
                            }, format = function (s, c) {
                                return s.replace(/{(\w+)}/g, function (m, p) {
                                    return c[p];
                                })
                            }
                        return function (table, name, filename) {
                            if (!table.nodeType) table = document.getElementById(table)
                            var ctx = {
                                worksheet: name || 'Worksheet',
                                table: table.innerHTML
                            }
                       document.getElementById("dlink").href = uri + base64(format(template, ctx));
                                document.getElementById("dlink").download = filename;
                                document.getElementById("dlink").click();
                        }
                    })()
                    </script>
                   <button class="button alert" onclick="printData('tableprint')"><span class="mif-printer mr-2"></span>In hóa đơn</button>
                   <button class="button success" id="btnExport"  onclick="tableToExcel('tableprintExcel', '{{$ma_seikyu}}', '{{$ma_seikyu}}.xls')"><span class="mif-file-excel mr-2"></span> Xuất excel </button>
                   <a id="dlink"  style="display:none;"></a>
                   <div  id="tableprint">
                    <style type="text/css">
                        body {
                            font-family: "Times New Roman", Times, serif;
                        }
                        tr td {
                            font-family: "Times New Roman", Times, serif;
                        }
                    </style>
                    <table id="tableprintExcel" class="table" cellspacing="0" cellpadding="0">
                        <tr >
                            <td colspan="9" style="text-align: center"><h3><strong>御請求書 <br>ĐỀ NGHỊ THANH TOÁN</strong></h3></td>
                        </tr>
                        <tr>
                            <td colspan="9"><br></td>
                        </tr>
                        <tr >
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="5">請求書番号：{{$ma_seikyu}}<br>Số Phiếu</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="5">{{date("Y",strtotime($date_created))}} 年{{date("m",strtotime($date_created))}}  月 {{date("d",strtotime($date_created))}} 日</td>
                        </tr>
                        <tr>
                            <td colspan="3"><strong>{{$nghiepdoan->name_jp}}<br>{{$nghiepdoan->name_vn}}</strong></td>
                            <td></td>
                            <td colspan="5"><strong>MIRAI HUMAN RESOURCE CO.,LTD</strong><br>26/4-26/5 Le Thanh Ton St, Ben Nghe Ward,</td>
                        </tr>
                        <tr>
                            <td colspan="3">{{$nghiepdoan->add_jp}}<br>{{$nghiepdoan->add_vn}}</td>
                            <td></td>
                            <td colspan="5">Dist.1, Ho Chi Minh City, Viet Nam<br>TEL: (84.28) 6686 3208</td>
                        </tr>
                        <tr>
                            <td colspan="3">TEL: {{$nghiepdoan->tel}}</td>
                            <td></td>
                            <td colspan="5">FAX: (84.28) 3873 3268</td>
                        </tr>
                        <tr>
                            <td colspan="3">FAX: {{$nghiepdoan->fax}}</td>
                            <td></td>
                            <td colspan="5"></td>
                        </tr>
                        <tr>
                            <td colspan="9"><br></td>
                        </tr>
                        <tr>
                            <td colspan="2">毎度有難うございます。	</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="9">下記の通り講習費用のご請求申し上げます。<br>Vui lòng thanh toán phí đào tạo theo bảng kê dưới đây.</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-decoration:underline"><strong>ご請求金額：￥{{number_format($tong)}}<br>Số tiền yêu cầu</strong></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="9"><br></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000;text-align:center ;border-right:0;border-bottom:0"><strong>会社名<br>Tên công ty</strong></td>
                            <td style="border: 1px solid #000;text-align:center ;border-right:0;border-bottom:0"><strong>入国日<br> Ngày nhập quốc</strong></td>
                            <td style="border: 1px solid #000;text-align:center ;border-right:0;border-bottom:0"><strong>回数<br>Số lần</strong></td>
                            <td style="border: 1px solid #000;text-align:center ;border-right:0;border-bottom:0"><strong>内容<br>Nội dung</strong></td>
                            <td style="border: 1px solid #000;text-align:center ;border-right:0;border-bottom:0"><strong>人数<br>Số người</strong></td>
                            <td style="border: 1px solid #000;text-align:center ;border-right:0;border-bottom:0"><strong>単価<br>Đơn giá</strong></td>
                            <td style="border: 1px solid #000;text-align:center ;border-right:0;border-bottom:0"><strong>月数<br>Số tháng</strong></td>
                            <td style="border: 1px solid #000;text-align:center ;border-right:0;border-bottom:0"><strong>期間<br>Thời gian</strong></td>
                            <td style="border: 1px solid #000;text-align:center;border-bottom:0"><strong>金額<br>Số tiền</strong></td>
                        </tr>
                        @foreach ($hocvien as $item)
                            <tr>
                                @foreach ($congty as $cty)
                                    @if ($item->id_congty == $cty->id)
                                        <td style="border: 1px solid #000;text-align:center ;border-right:0;border-bottom:0">{{$cty->name_jp}}<br>{{$cty->name_vn}}</td>
                                    @endif
                                @endforeach
                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-bottom:0">{{date('Y',strtotime($item->ngay_xc))}}年{{date('m',strtotime($item->ngay_xc))}}月{{date('d',strtotime($item->ngay_xc))}}日</td>
                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-bottom:0">{{$item->solan}}</td>
                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-bottom:0">講習費用</td>
                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-bottom:0">{{$item->sohocvien}}</td>
                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-bottom:0">¥ 5,000</td>
                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-bottom:0">
                                    @if (($item->solan+$sothang)>36)
                                        {{36-$item->solan}}
                                    @else
                                        {{$sothang}}
                                    @endif
                                </td>
                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-bottom:0">
                                    @if ($item->ngay_seikyu == null)
                                        @if (($item->solan+$sothang)>36)
                                            <?php $thang=36-$item->solan ?>
                                        @else
                                            <?php $thang=$sothang?>
                                        @endif
                                        @php
                                            echo(date('Y',strtotime(date('Y-m-d'))).'年'.date('m',strtotime(date('Y-m-d'))).'月'.date('d',strtotime(date('Y-m-d'))).'日'.'~'.date('Y',strtotime("+$thang month",strtotime(date('Y-m-d')))).'年'.date('m',strtotime("+$thang month",strtotime(date('Y-m-d')))).'月'.date('d',strtotime("+$thang month",strtotime(date('Y-m-d')))).'日');
                                            $ngayseikyu=date('Y-m-d',strtotime("+$thang month",strtotime(date('Y-m-d'))));
                                            $a = DB::table('hocvien')->where([['id_ndoan',$id_ndoan],['id_congty',$item->id_congty],['ngay_xc',$item->ngay_xc]])->update(['ngay_seikyu'=>$ngayseikyu]);
                                        @endphp
                                    @else
                                        @if (($item->solan+$sothang)>36)
                                            <?php $thang=36-$item->solan ?>
                                        @else
                                            <?php $thang=$sothang?>
                                        @endif
                                        @php
                                            echo(date('Y',strtotime($item->ngay_seikyu)).'年'.date('m',strtotime($item->ngay_seikyu)).'月'.date('d',strtotime($item->ngay_seikyu)).'日 ~' .date('Y',strtotime("+$thang month",strtotime($item->ngay_seikyu)))."年".date('m',strtotime("+$thang month",strtotime($item->ngay_seikyu))).'月'.date('d',strtotime("+$thang month",strtotime($item->ngay_seikyu))).'日');
                                            $ngayseikyu=date('Y-m-d',strtotime("+$thang month",strtotime($item->ngay_seikyu)));
                                            $a = DB::table('hocvien')->where([['id_ndoan',$id_ndoan],['id_congty',$item->id_congty],['ngay_xc',$item->ngay_xc]])->update(['ngay_seikyu'=>$ngayseikyu]);
                                        @endphp
                                    @endif
                                </td>
                                <td style="border: 1px solid #000;text-align:center;border-bottom:0">
                                    @if (($item->solan+$sothang)>36)
                                        ¥{{number_format($item->sohocvien*5000*(36-$item->solan))}}
                                    @else
                                        ¥{{number_format($item->sohocvien*5000*$sothang)}}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td style="border: 1px solid #000;text-align:center;border-right:0"  colspan="4"><strong>合計</strong></td>
                            <td style="border: 1px solid #000;text-align:center;border-right:0" ><strong>{{$tonghocvien}}<strong></td>
                            <td style="border: 1px solid #000;text-align:center;border-right:0" ></td>
                            <td style="border: 1px solid #000;text-align:center;border-right:0" ></td>
                            <td style="border: 1px solid #000;text-align:center;border-right:0" ></td>
                            <td style="border: 1px solid #000;text-align:center"><strong>¥{{number_format($tong)}}</strong></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="7">下記の口座にお振り込み頂きます様、宜しくお願い致します。</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>銀行名<br>Tên ngân hàng</td>
                            <td colspan="7">{{$nganhang->tennh}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>支店名<br>Tên chi nhánh</td>
                            <td colspan="3">{{$nganhang->chinhanh}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>住所<br>Địa chỉ</td>
                            <td colspan="7">{{$nganhang->dc}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>電話番号<br>Số điện thoại</td>
                            <td colspan="2">{{$nganhang->sdt}}</</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @if ($nganhang->tennh!='三井住友銀行')
                            <tr>
                                <td>SWIFT CODE</td>
                                <td>{{$nganhang->swiftcode}}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif
                        <tr>
                            <td>口座番号<br>Số tài khoản</td>
                            <td colspan="3">‎{{$nganhang->sotk}}（日本円） </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>口座名義<br>Tên tài khoản</td>
                            <td colspan="5">{{$nganhang->tentk}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>手数料<br>Phí chuyển khoản</td>
                            <td colspan="4">振込み手数料はお客様のご負担となります</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>支払期限<br>Thời hạn thanh toán</td>
                            <td colspan="8">{{date("Y",strtotime("+1 month",strtotime($date_created)))}}  年  {{date("m",strtotime("+1 month",strtotime($date_created)))}} 月 {{date("d",strtotime("+1 month",strtotime($date_created)))}} 日まで</td>
                        </tr>
                    </table>
                   </div>
                </div>
            </div>
        </div>
    </aside>
</section>
@endsection
@section('JsLibraries')
@endsection
