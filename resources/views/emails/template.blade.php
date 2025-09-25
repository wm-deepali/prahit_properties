<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Parhit Properties</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">	
        <tr>
            <td style="padding: 10px 0 30px 0;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
                    <tr>
                        <td style="color: #153643; padding:10px 0;font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
                            <img src="{{ $data['logo'] }}" alt="lOGO" width="200px" height="auto" style="display: block;" />
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 10px 0 10px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
                            @if (isset($data['image']) && Storage::exists($data['image']))
                                <img src="{{ asset('storage') }}/{{ $data['image'] }}" alt="Welcome" width="100%" height="auto" style="display: block;"/>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 10px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px;">
                                        {!! $data['template'] !!}
                                    </td>
                                    </tr>
                                    <tr>
                                        <td style="color: #153643; padding:10px 0;font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
                                            <img src="{{ $data['logo'] }}" alt="lOGO" width="200px" height="auto" style="display: block;" />
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>
</table>
</body>
</html>