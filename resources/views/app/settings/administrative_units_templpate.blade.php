<div id="administrative_units">
    <ul>
        @foreach($cities as $city)
        <li id="js_node_{{$city->id}}">
            <span class="city_name">{{$city->name}}</span>
            <span style="margin-left: 5px; color: blue;" onclick="addUnit({{$city->id}},'{{$city->name}}',{{$city->level}})">Thêm</span>&nbsp;
            <span style="margin-left: 5px; color: blue;" onclick="editUnit({{$city->id}},'{{$city->name}}')">Sửa</span>&nbsp;
            <span style="margin-left: 5px; color: blue;" onclick="deleteUnit({{$city->id}})">Xóa</span>
            <ul>
                @foreach($city->districts as $district)
                <li id="js_node_{{$district->id}}">
                    <span class="district_name">{{$district->name}}</span>
                    <span style="margin-left: 5px; color: blue;" onclick="addUnit({{$district->id}},'{{$district->name}}',{{$district->level}})">Thêm</span>&nbsp;
                    <span style="margin-left: 5px; color: blue;" onclick="editUnit({{$district->id}},'{{$district->name}}')">Sửa</span>&nbsp;
                    <span style="margin-left: 5px; color: blue;" onclick="deleteUnit({{$district->id}})">Xóa</span>
                    <ul>
                        @foreach($district->wards as $ward)
                        <li id="js_node_{{$ward->id}}">
                            <span class="ward_name">{{$ward->name}}</span>
                            <span style="margin-left: 5px; color: blue;" onclick="editUnit({{$ward->id}},'{{$ward->name}}')">Sửa</span>&nbsp;
                            <span style="margin-left: 5px; color: blue;" onclick="deleteUnit({{$ward->id}})">Xóa</span>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </li>
        @endforeach
    </ul>
</div>