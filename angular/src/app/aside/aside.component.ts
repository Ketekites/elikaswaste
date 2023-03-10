import { Component, OnInit } from '@angular/core';
import { Location } from '@angular/common';
import { LoginService } from '../services/login.service';

@Component({
  selector: 'app-aside',
  templateUrl: './aside.component.html',
  styleUrls: ['./aside.component.scss']
})
export class AsideComponent implements OnInit {

  public activo:string=""
  public loginStatus$:any
  public alertInfo$:any

  constructor(private _loginService:LoginService, private _loc: Location) {}

  ngOnInit(): void {
    this._loginService.loginStatus$.subscribe((status:boolean) => this.loginStatus$ = status)
    this._loginService.alertInfoStatus$.subscribe((status:boolean) => this.alertInfo$ = status)

    switch (this._loc.path()) {
      case "/perfil":
        this.activo = "perfil"
        break;
      case "/perfil/opiniones":
        this.activo = "perfil"
        break;
      case "/donar":
        this.activo = "donar"
        break;
      case "/donar/en-curso":
        this.activo = "donar"
        break;
      case "/donar/finalizadas":
        this.activo = "donar"
        break;
      case "/buscar":
        this.activo = "buscar"
        break;
      case "/pedidos":
        this.activo = "pedidos"
        break;
      case "/pedidos/finalizados":
        this.activo = "pedidos"
        break;
      case "/pedidos/recogidos":
        this.activo = "pedidos"
        break;
      case "/ayuda":
        this.activo = "ayuda"
        break;
    }
  }

  accessControl():void {
    this._loginService.readUserLogged("token").subscribe({
      next : data => {
        if(data!=0) {
          // Controlar si no esta rellenados direccion y CP
          if(data[0].direccion!='' && data[0].cp!=null){ // Si estan rellenados
            this._loginService.setalertInfoStatus(false)
            this._loginService.setToken("info",btoa(this.alertInfo$))
          } else {
            this._loginService.setalertInfoStatus(true)
          }
        }
      }
    })
  }

}
