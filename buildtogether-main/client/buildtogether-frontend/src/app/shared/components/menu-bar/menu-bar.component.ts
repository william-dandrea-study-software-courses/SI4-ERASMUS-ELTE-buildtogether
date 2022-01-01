import {Component, NgZone, OnInit} from '@angular/core';
import {AuthService} from "../../../core/service/auth.service";
import {Router} from "@angular/router";




@Component({
  selector: 'app-menu-bar',
  templateUrl: './menu-bar.component.html',
  styleUrls: ['./menu-bar.component.scss']
})
export class MenuBarComponent implements OnInit {

  public numbers = Array(100).fill(0).map((x,i)=>i);

  public MENU_OPTIONS = [
    {
      menu_name: 'Dashboard',
      icon: 'space_dashboard',
      is_selected: false,
      url: 'dashboard',
    },
    {
      menu_name: 'Posts',
      icon: 'feed',
      is_selected: true,
      url: 'posts',
    },
    {
      menu_name: 'Public Projects',
      icon: 'public',
      is_selected: false,
      url: 'public-projects',
    }
  ]



  constructor(private authService: AuthService, private ngZone: NgZone, private router: Router) { }

  ngOnInit(): void {
  }








  public changeMenuPage(index: number): void {
    this.setAllMenuOptionsToFalse()
    this.MENU_OPTIONS[index].is_selected = true;

    this.ngZone.run(() => {
      this.router.navigate(['home', this.MENU_OPTIONS[index].url])
    })
  }


  public goToUserProfil(): void {
    this.setAllMenuOptionsToFalse();
    this.ngZone.run(() => {
      this.router.navigate(['home', 'user-profile'])
    })
  }




  private setAllMenuOptionsToFalse(): void {
    this.MENU_OPTIONS.forEach(value => value.is_selected = false)
  }

  public disconnect(): void {
    this.authService.signOut();
  }





}
